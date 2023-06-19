<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\HasApiTokens;


class AuthController extends Controller
{
    /**
     * login any user.
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
                    'message' => 'veillew valider votre adresse mail'
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
                            'name' => $user->name,
                            'email' => $user->email,
                            'code postal' => $user->code_postal,
                            'avatar_url' => asset($user->avatar),
                        ]
                    ]
                ]);
            }
        } else {
            return ['error', 'Email-Address And Password Are Wrong.'];
        }
    }


    /**
     * login any user.
     */
    public function loginWithCode(AuthRequest $request, User $user)
    {

        $data = $request->validated();

        if ($user->codde === $data) {

            $token = $user->createToken('API TOKEN');

            return response()->json([
                'code' => 200,
                'data' => [
                    'token' => [
                        'type' => 'Bearer',
                        'expires_at' =>  Carbon::parse($token->accessToken->expires_at),
                        'access_token' => $token->plainTextToken
                    ]
                ]
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'data' => 'code incorrect'
            ], 400);
        }
    }


    /**
     * login any user.
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


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
