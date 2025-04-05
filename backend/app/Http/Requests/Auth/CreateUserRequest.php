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
            'name.required' => 'Поле имя обязательно для заполнения',
            'name.min' => 'Имя должно быть не менее 3 символов',
            'name.max' => 'Имя не должно превышать 50 символов',

            'email.required' => 'Поле email обязательно для заполнения',
            'email.email' => 'Введите корректный email адрес',
            'email.max' => 'Email не должен превышать 255 символов',
            'email.unique' => 'Пользователь с таким email уже существует',

            'phone.required' => 'Поле телефон обязательно для заполнения',
            'phone.regex' => 'Введите телефон в формате +71234567890',
            'phone.unique' => 'Пользователь с таким телефоном уже существует',

            'password.required' => 'Поле пароль обязательно для заполнения',
            'password.min' => 'Пароль должен быть не менее 6 символов',
            'password.max' => 'Пароль не должен превышать 150 символов',
            'password.confirmed' => 'Пароли не совпадают',
            'password.regex' => 'Пароль должен содержать минимум: 1 заглавную букву, 1 цифру и 1 спецсимвол',

            'password_confirmation.required' => 'Подтверждение пароля обязательно',
            'password_confirmation.same' => 'Пароли должны совпадать',
        ];
    }
}
