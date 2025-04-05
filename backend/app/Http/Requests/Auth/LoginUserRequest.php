<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                'max:255',
                'exists:users,email',
            ],

            'password' => [
                'max:150',
                'min:6',
                'required',
                'string',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{6,}$/'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Поле email обязательно для заполнения',
            'email.email' => 'Введите корректный email адрес',
            'email.max' => 'Email не должен превышать 255 символов',
            'email.exists' => 'Пользователь с таким email не найден',

            'password.required' => 'Поле пароль обязательно для заполнения',
            'password.min' => 'Пароль должен быть не менее 6 символов',
            'password.max' => 'Пароль не должен превышать 150 символов',
            'password.regex' => 'Пароль должен содержать минимум: 1 заглавную букву, 1 цифру и 1 спецсимвол',
        ];
    }
}
