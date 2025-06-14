<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPassRequest extends FormRequest
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
            'password' => 'required|string|min:6|max:40|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'password.min' => 'Пароль должен содержать минимму из 6 символов',
            'password.max' => 'Пароль должен содержать максимум из 40 символов',
            'password.confirmed' => 'Пароли не совпадают',
        ];
    }
}
