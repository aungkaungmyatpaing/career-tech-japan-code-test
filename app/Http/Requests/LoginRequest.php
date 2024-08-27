<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => ['required', 'email', 'string', 'min:6'],
            'password' => ['required', 'string', 'min:6', 'regex:/^\S*$/'],
        ];
    }
}
