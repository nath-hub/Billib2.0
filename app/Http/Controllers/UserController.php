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
     * Store a newly created resource in storage.
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
     * Store a newly created resource in storage.
     */
    public function createIdentifiant($id)
    {
        $data = UserService::createIdentifiants($id);

        return $data;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function uploadAvatar(UserRequest $request)
    {
        $data = UserService::uploadAvatar($request->file('avatar_file'));

        return response()->json($data, 200);
    }



    /**
     * Display the specified resource.
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
     * Display the specified resource.
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
     * Display the specified resource.
     */
    public function checkVerificationCode(UserRequest $request, User $user)
    {

        $input = $request->validated();

        return UserService::checkVerificationCode($input, $user);
    }



    /**
     * Update the specified resource in storage.
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
     * Update password or code shot of the user.
     */
    public function updatePasswordOrCode(UserRequest $request, User $user)
    {
        $input = $request->validated();

        return UserService::updatePasswordOrCode($input, $user);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        UserService::delete($user);

        return response()->json([
            'message' => 'users successfull delete'
        ], 202);
    }

    /**
     * @OA\Post(
     *      path="/api/login",
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
     *       @OA\Property(property="name", type="string", format="string", example="nathalie", description ="votre nom"),
     *       @OA\Property(property="email", type="string", format="string", example="examples@gmail.com", description ="votre email"),
     *      @OA\Property(property="password", type="string", format="string", example="sdms", description ="votre password"),
     *      @OA\Property(property="code_postal", type="string", format="string", example="123456", description ="votre code_ ostal"),
     *            )
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



    /**
     * @OA\Get(
     *     path="/api/user",
     *     summary="Get current user",
     *     description="Returns information about the current user if the request is authenticated",
     *     @OA\Response(
     *         response=200,
     *         description="Everything OK"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Access Denied"
     *     )
     * )
     */
}
