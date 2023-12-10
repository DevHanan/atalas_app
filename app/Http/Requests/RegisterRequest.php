<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "first_name"            => 'required|string',
            "last_name"            => 'required|string',

            "email"                 => 'required|email|unique:clients,email',
            'password'              => 'required|confirmed|min:8',
            "district_id"                 => 'required|exists:districts,id'




        ];
    }
}
