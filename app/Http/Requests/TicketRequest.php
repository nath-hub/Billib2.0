<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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

        $verb = $this->method();

        $routeName = $this->route()->getName();

        if ($verb === 'POST') {

            if ($routeName === 'filter') {
                return [
                    'name_store' => 'sometimes|required',
                    'adresse' => 'sometimes|required|string',
                    'name_article' => 'sometimes|required',
                    'categories' => 'sometimes|required',
                    'unity_price' => 'sometimes|required',
                    'total' => 'sometimes|required',
                ];
            } elseif ($routeName === 'tickets.store') {

                return [
                    'name_store' => 'required',
                    'phone' => 'required|string',
                    'adresse' => 'required|string',
                    'name_cashier' => 'required|string',
                    'total_payable' => 'required',
                    'net' => 'required',
                    'tva' => 'required',
                    'number_ticket' => 'required|unique:tickets',
                    'datas' => [
                        "name_article" => "required",
                        "quantity" => "required",
                        "unity_price" => "required",
                        "total" => "required",
                        "notice" => "required",
                        "notice_doc" => "required",
                        "garantie" => "required",
                        "tuto" => "required",
                        "reparation" => "required",
                        "other_model" => "required",
                        "revente" => "required",
                        "categories" => "required"
                    ],

                ];
            }
        } elseif ($verb === 'PUT') {
            return [
                'name_store' => 'sometimes|required',
                'phone' => 'sometimes|required|string',
                'adresse' => 'sometimes|required|string',
                'name_cashier' => 'sometimes|required|string',
                'total_payable' => 'sometimes|required',
                'net' => 'sometimes|required',
                'tva' => 'sometimes|required',
                'number_ticket' => 'sometimes|required|unique:tickets',
                'datas' => [
                    'name_article' => 'sometimes|required',
                    'quantity' => 'sometimes|required',
                    'unity_price' => 'sometimes|required',
                    'total' => 'sometimes|required',
                    'notice' => 'sometimes|required',
                    'notice_doc' => 'sometimes|required',
                    'garantie' => 'sometimes|required',
                    'tuto' => 'sometimes|required',
                    'reparation' => 'sometimes|required',
                    'other_model' => 'sometimes|required',
                    'revente' => 'sometimes|required',
                    'categories' => 'sometimes|required',
                ]
            ];
        };
        return [];
    }
}
