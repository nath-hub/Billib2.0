<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        $routeName = $this->route()->getName();

        if ($routeName === 'users.code') {
            return [
                'code' => 'required|string'
            ];
        } elseif($routeName === 'users.login') {
            return [
                'data' => ['required'],
                'password' => ['required'],
            ];
        }
        return [
        ];
    }
}
