<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:50',
                'min:3',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users',
            ],

            'phone' => [
                'required',
                'string',
                'unique:users',
                'regex:/^\+?\d{7,15}$/',
            ],

            'password' => [
                'max:150',
                'min:6',
                'required',
                'string',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{6,}$/'
            ],

            'password_confirmation' => [
                'required',
                'same:password'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'login.regex' => 'Логин может содержать только буквы, цифры, дефисы и подчеркивания',
            'phoneNumber.regex' => 'Некорректный формат телефона.',
        ];
    }
}
