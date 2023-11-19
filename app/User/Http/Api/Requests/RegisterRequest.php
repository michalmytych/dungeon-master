<?php

namespace App\User\Http\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'password' => 'required|string|confirmed',
            'email' => 'required|string|email|unique:users,email'
        ];
    }
}
