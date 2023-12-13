<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

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

        $user->email_verified_at = Carbon::now();

        $upUser = $user->update();

        Mail::send('notificationIdentifiant', ['identifiant' => $identifiant], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject("E-mail de félicitation");
        });

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

            if ($user[0]->email_verified_at === null) {
                return response()->json(["statut" => 400, "message" => "veuillez valider votre adresse mail"], 400);
            } else {

                $email = $user[0]->email;

                $verify = random_int(100000, 999999);

                Mail::send('sendCode', ['verify' => $verify, 'id'=>$user[0]->id], function ($message) use ($email) {
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
    public function checkVerificationCode(array $input)
    {

        $user = User::email($input['email'])->get();

        if ($input['validation'] == $user[0]->validation) {

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
        if (isset($dataToUpdate['password'])) {

            $dataToUpdate['password'] = Hash::make($dataToUpdate['password']);
        }

        $user->update($dataToUpdate);
    }



    /**   
     * Upload user avatar
     * 
     * @param UploadedFile $avatarFile The avatar file
     * 
     * @return array
     */
    public function uploadAvatar(UploadedFile $avatarFile, $user)
    {
        $avatarPath = $avatarFile->store('users/avatar', 'public');

        $user->avatar = asset('/storage/' . $avatarPath);

        $user->update();

        return [
            asset('/storage/' . $avatarPath)
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
