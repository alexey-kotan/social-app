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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email', // required - поле не пустое
            'password' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Поле Email не может быть пустым.',
            'email.email' => 'Некорректый email.',

            'password.required' => 'Поле Пароль не может быть пустым.',
            'password.string' => 'Некорректый пароль.',
        ];
    }
}
