<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\Facades\UserFacade as UserService;


/**
 *
 *@OA\PathItem(
 *path="/users/{user}",
 *)
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * @OA\Post(
     *      path="/api/users",
     *      operationId="store",
     *      tags={"User"},
     *      summary="Register",
     *      description="Register",
     *      @OA\RequestBody(
     *      required=true,
     *      description="Enregistrement d'un nouvel utilisateur",
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *       @OA\Property(property="name", type="string", format="string", example="laporte", description ="votre nom"),
     *       @OA\Property(property="avatar", type="string", format="string", example="https://kdjfkd.png", description ="votre photo"),
     *       @OA\Property(property="code_postal", type="string", format="90931", example="384489", description ="votre code postal"),
     *       @OA\Property(property="email", type="string", format="string", example="examples@gmail.com", description ="votre email"),
     *       @OA\Property(property="password", type="string", format="string", example="sdms", description ="votre password"),
     *       @OA\Property(property="code", type="string", format="string", example="123456", description ="votre code"),
         
     *  )
     *        ),
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="Utilisateur bien Creer."),
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
    public function store(UserRequest $request)
    {
        $input = $request->validated();

        $data = UserService::store($input);

        return response()->json([
            'code' => 201,
            'data' => $data
        ]);
    }


    /**
     * @OA\Get(
     *     path="/api/notification/identifiant/{id}",
     *      operationId="createIdentifiant",
     *      tags={"User"},
     *      summary="Create identifier of User",
     *      description="Create identifier of User",
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "user id",
     *      example="10",
     *      @OA\Schema(
     *           type="integer"
     *      )
     * ),
     *
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="identifient bien créé."),
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
    public function createIdentifiant($id)
    {
        $data = UserService::createIdentifiants($id);

        return $data;
    }


     /**
     * @OA\Post(
     *      path="/api/uploadFile/{id}",
     *      operationId="uploadAvatar",
     *      tags={"User"},
     *      summary="upload avatar file",
     *      description="upload avatar file",
     * security={{"bearerAuth": {{}}}},
     *      @OA\RequestBody(
     *      required=true,
     *      description="Telechargement de la photo de profil utilisateur",
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *      @OA\Property(property="avatar", type="file", format="image", example="https://image.png", description ="votre photos de profil"),   
     *  )
     *        ),
     *      ),
     *    @OA\Response(
     *      response=200,
     *      description="success",
     *      @OA\JsonContent(
     *      @OA\Property(property="avatar_path", type="string", example="users/avatar/ghRfjbiJHOvnMBaeerGTwCbYxV0WEnRuRPFod9N3.jpg"),
     * @OA\Property(property="avatar_url", type="string", example="http://tchallenger.test/users/avatar/ghRfjbiJHOvnMBaeerGTwCbYxV0WEnRuRPFod9N3.jpg",
     *
     *        
     * )
     *     ),
     *    @OA\Response(
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
    public function uploadAvatar(UserRequest $request)
    {
        $data = UserService::uploadAvatar($request->file('avatar_file'));

        return response()->json($data, 200);
    }



     /**
     * @OA\Get(
     *     path="/api/users/{id}",
     *      operationId="show",
     *      tags={"User"},
     *      summary="Get User",
     *      description="Get User",
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "user id",
     *      example="10",
     *      @OA\Schema(
     *           type="integer"
     *      )
     * ),
     *
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="affichage d'un utilisateur."),
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
    public function show(User $user)
    {
        $data = UserService::show($user);

        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }




    /**
     * @OA\Post(
     *      path="/api/check/email",
     *      operationId="checkEmail",
     *      tags={"User"},
     *      summary="verification",
     *      description="send email",
     *      @OA\RequestBody(
     *      required=true,
     *      description="Envoie du mail de verification a un nouvel utilisateur",
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *      @OA\Property(property="email", type="string", format="string", example="examples@gmail.com", description ="votre email"),  
     *  )
     *        ),
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="mail bien envoyer."),
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
    public function checkEmail(UserRequest $request)
    {

        $data = $request->validated();

        $data = UserService::checkEmail($data);

        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }



     /**
     * @OA\Post(
     *      path="/api/check/validation/email/{user}",
     *      operationId="checkVerificationCode",
     *      tags={"User"},
     *      summary="verification of code send in email",
     *      description="send email",
     *      @OA\RequestBody(
     *      required=true,
     *      description="confirmation du mail de verification a un nouvel utilisateur",
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *      @OA\Property(property="email", type="string", format="string", example="examples@gmail.com", description ="votre email"),  
     *  )
     *        ),
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="mail bien envoyer."),
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
    public function checkVerificationCode(UserRequest $request, User $user)
    {

        $input = $request->validated();

        return UserService::checkVerificationCode($input, $user);
    }



    /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *      operationId="update",
     *      tags={"User"},
     *      summary="Update User",
     *      description="Update User",
     * security={{"bearerAuth": {{}}}},
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "user id",
     *      example="10",
     *      @OA\Schema(
     *           type="integer"
     *      )
     * ),
     *
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="reponse de la modification"),
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
    public function update(UserRequest $request, User $user)
    {
        $input = $request->validated();

        UserService::update($input, $user);

        return response()->json([
            'message' => 'users successfull update'
        ], 202);
    }




    /**
     * @OA\Put(
     *      path="/api/update/password/{id}",
     *      operationId="updatePasswordOrCode",
     *      tags={"User"},
     *      summary="update password or code",
     *      description="update password or code",
     *   @OA\Parameter(
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
     *      description="modification du mot de passe d'un utilisateur",
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *    @OA\Property(property="email", type="string", format="string", example="examples@gmail.com", description ="votre email"),
     *  )
     *        ),
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="modification du mot de passe."),
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
    public function updatePasswordOrCode(UserRequest $request, User $user)
    {
        $input = $request->validated();

        return UserService::updatePasswordOrCode($input, $user);
    }



    /**
     * @OA\Delete(
     *      path="/api/users/{id}",
     *      operationId="destroy",
     *      tags={"User"},
     *      summary="delete user",
     *      description="delete user",
     * security={{"bearerAuth": {{}}}},
     * 
     *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "user id",
     *      example="10",
     *      @OA\Schema(
     *           type="integer"
     *      )
     * ),
     *      
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="modification du mot de passe."),
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
    public function destroy(User $user)
    {
        UserService::delete($user);

        return response()->json([
            'message' => 'users successfull delete'
        ], 202);
    }

  
}
