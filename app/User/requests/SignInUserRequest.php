<?php

namespace App\User\requests;

use Illuminate\Foundation\Http\FormRequest;

class SignInUserRequest extends FormRequest
{
    public function authorize() : bool{
        return true;
    }
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ];
    }
}
