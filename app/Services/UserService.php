<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserService
{


    /**
     * Create a info of user
     * 
     * @param User $user 
     * @param array $input The user data
     * 
     * @return string The newly created data of the user
     */
    public function store(array $input)
    {

        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);

        Mail::send('mailVerification', ['verify' => $user->id], function ($message) use ($input) {
            $message->to($input['email']);
            $message->subject("E-mail de validation");
        });

        return $user;
    }


    /**
     * Create a identifiant of user
     * 
     * @param User $user 
     * @param array $input The user identifiant
     * 
     * @return string The newly created identifiant of the user
     */
    public function createIdentifiants(int $id)
    {

        $random = random_int(100000000, 999999999);

        $identifiant = "33" . $random;

        $user = User::findOrFail($id);

        $user->identifiant = $identifiant;

        $upUser = $user->update();

        if ($upUser) {
            return view('notificationIdentifiant', ['identifiant' => $identifiant]);
        } else {

            return 0;
        }
    }



    /**
     * show a user
     * 
     * @param User $user the user show her account
     * 
     * @return array
     */
    public function show(User $user): array
    {
        return [
            'user' => $user
        ];
    }



    /**
     * verify a email user
     * 
     * @param User $user the info of user
     * 
     * @return array
     */
    public function checkEmail($data) //: array
    {

        $user = User::email($data['email'])->get();

        if (isset($user)) {

            $email = $user[0]->email;

            $verify = random_int(100000, 999999);

            Mail::send('mailVerification', ['verify' => $verify], function ($message) use ($email) {
                $message->to($email);
                $message->subject("E-mail de validation");
            });

            $user = User::findOrFail($user[0]->id);

            $user->validation = $verify;

            $user->update();

            return [
                "statut" => 200, "data" => $user
            ];
        }

        return [];
    }




    /**
     * verification of code who is send in email of user
     * 
     * @param array $input data of user input
     * 
     * @param User $user user
     */
    public function checkVerificationCode(array $input, User $user)
    {

        if ($input['validation'] == $user->validation) {

            $user->email_verified_at = Carbon::now();

            $user->update();

            return response()->json(["statut" => 200, "message" => "your code is correct"], 200);
        } else {
            return response()->json(["statut" => 400, "message" => "your code is incorrect"], 400);
        }
    }



    /**
     * Update a user
     * 
     * @param User $user the a user who updates his data
     * @param array $input The user data
     * 
     * @return void
     */
    public function update($dataToUpdate, $user)
    {

        $user->update($dataToUpdate);
    }


    /**
     * Update a user
     * 
     * @param User $user the a user who updates his data
     * @param array $input The user data
     * 
     */
    public function updatePasswordOrCode($dataToUpdate, $user)
    {

        if (isset($dataToUpdate['password'])) {
            $dataToUpdate['password'] = Hash::make($dataToUpdate['password']);
        }

        $user->update($dataToUpdate);

        return response()->json([], 204);
    }



    /**   
     * Upload user avatar
     * 
     * @param UploadedFile $avatarFile The avatar file
     * 
     * @return array
     */
    public function uploadAvatar(UploadedFile $avatarFile)
    {

        $avatarPath = $avatarFile->store('users/avatar', 'public');

        return [
            'avatar_path' => $avatarPath,
            'avatar_url' => asset($avatarPath),
        ];
    }


    /**
     * Delete a user
     * 
     * @param array $input The user id
     * 
     * @return void
     */
    public function delete($userToDelete)
    {
        $userToDelete->delete();
    }
}
