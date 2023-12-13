<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/login",
     *      operationId="login",
     *      tags={"Auth"},
     *      summary="login",
     *      description="login",
     *      @OA\RequestBody(
     *      required=true,
     *      description="connexion d'un utilisateur",
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *       @OA\Property(property="data", type="string", format="email", example="exmple@exemple.com", description ="votre email"),
     *       @OA\Property(property="password", type="string", format="string", example="jdjfk3237&$#", description ="votre motde passe"),
     *  )
     *        ),
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="Connexion effectuée"),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     ),
     * @OA\Response(
     *      response=500,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="500"),
     *      @OA\Property(property="message", type="string", example="Erreur de connexion")
     *        )
     *     )
     * )
     *      
     * )
     */
    public function login(AuthRequest $request)
    {
        $data = $request->validated();

        $login_type = filter_var($data['data'], FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'identifiant';

        $data[$login_type] = $data['data'];

        unset($data['data']);

        if (auth()->attempt(array($login_type => $data[$login_type], 'password' => $data['password']))) {

            $user = $request->user();

            if ($user->identifiant === null) {
                return response()->json([
                    'code' => 400,
                    'message' => 'veillez valider votre adresse mail'
                ], 400);
            } else {
                $token = $user->createToken('API TOKEN');

                return response()->json([
                    'code' => 200,
                    'data' => [
                        'token' => [
                            'type' => 'Bearer',
                            'expires_at' =>  Carbon::parse($token->accessToken->expires_at),
                            'access_token' => $token->plainTextToken
                        ],
                        'user' => [
                            'id' => $user->id,
                          	'name' => $user->name,
                            'email' => $user->email,
                            'code' => $user->code,
                            'update_at' => $user->updated_at,
                            'identifiant' => $user->identifiant,
                            'code_postal' => $user->code_postal,
                            'avatar' => asset($user->avatar),
                        ]
                    ]
                ]);
            }
        } else {
            return ['error', 'Email-Address And Password Are Wrong.'];
        }
    }


    /**
     * @OA\Post(
     *      path="/api/loginCode/{user}",
     *      operationId="loginWithCode",
     *      tags={"Auth"},
     *      summary="login",
     *      description="login",
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "user id",
     *      example="10",
     *      @OA\Schema(
     *           type="integer"
     *      )
     * ),
     *      @OA\RequestBody(
     *      required=true,
     *      description="connexion d'un utilisateur",
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *       @OA\Property(property="email", type="string", format="email", example="exmple@exemple.com", description ="votre email"),
     *       @OA\Property(property="password", type="string", format="string", example="jdjfk3237&$#", description ="votre motde passe"),
     *  )
     *        ),
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="Connexion effectuée"),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     ),
     * @OA\Response(
     *      response=500,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="500"),
     *      @OA\Property(property="message", type="string", example="Erreur de connexion")
     *        )
     *     )
     * )
     *      
     * )
     */
    public function loginWithCode(AuthRequest $request, User $user)
    {

        $data = $request->validated();

        if ($data['code'] === $user->code) {

            $token = $user->createToken('API TOKEN');

            return response()->json([
                'code' => 200,
                'data' => [
                    'token' => [
                        'type' => 'Bearer',
                        'expires_at' =>  Carbon::parse($token->accessToken->expires_at),
                        'access_token' => $token->plainTextToken,
                      	'id' => $user->id
                    ]
                ]
            ], 200);

        } elseif($user->code === null) {

            $user->update($data);

            return response()->json([
                'code' => 200,
                'data' =>'bien creee!'
            ]);
        }

        return response()->json([
            'code' => 400,
            'data' => 'code incorrect'
        ], 400);
    }


    /**
     * @OA\Post(
     *      path="/api/logout/{user}",
     *      operationId="logout",
     *      tags={"Auth"},
     *      summary="logout of user",
     *      description="logout",
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "user id",
     *      example="10",
     *      @OA\Schema(
     *           type="integer"
     *      )
     *      ),
     *  @OA\RequestBody(
     *      required=true,
     *      description="déconnexion d'un utilisateur",
     *
     * 
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="deconnexion effectuée"),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     ),
     * @OA\Response(
     *      response=500,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="500"),
     *      @OA\Property(property="message", type="string", example="Erreur de connexion")
     *        )
     *     )
     * )
     *      
     * )
     */
    public function logout(Request $request, User $user)
    {

        Auth::guard('web')->logout();

        $user->tokens()->delete();

        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'code' => 200,
            'data' => $user,
            'message' => 'vous êtes bien déconnecté'
        ]);
    }


}
