<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return string
     */
    public function rules(): array
    {
        $verb = $this->method();

        $routeName = $this->route()->getName();

        if ($verb === 'POST') {

            if ($routeName === 'users.store') {

                return [
                    'name' => 'required|string',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|string',
                    'code' => 'integer',
                    'code_postal' => 'required|string',
                    'avatar' => 'string',
                ];
            } elseif ($routeName === 'users.avatar') {

                return [
                    'avatar' => 'required|image'
                ];
            }elseif($routeName === 'validation.email'){
                return [
                    'validation' => 'required|integer'
                ];
            }elseif($routeName === 'check.email' || 'recover.identifiant'){
                return [
                    'email' => 'required|email'
                ];
            }
        } elseif ($verb === 'PUT') {

            if($routeName === 'update.password'){
                return [
                    'password' => 'sometimes|required|string',
                    'code' => 'sometimes|required|string',
                ];
            }
            return [
                'name' => 'sometimes|required|string',
                'email' => 'sometimes|required|email|unique:users',
                'code' => 'sometimes|required|string',
                'code_postal' => 'sometimes|required|string',
                'avatar' => 'sometimes|required|string',
            ];
        }
        return [];
    }
}
