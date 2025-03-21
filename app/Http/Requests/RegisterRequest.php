<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:20|unique:users,name|regex:/^(?! )[\wа-яА-Я]+(?: [\wа-яА-Я]+)*(?<! )$/u',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|max:40|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.regex' => 'Имя может содержать только буквы и цифры, не более одного пробела подряд.',
            'name.min' => 'Имя должно содержать минимму из 2 символов',
            'name.max' => 'Имя должно содержать максимум из 20 символов',
            'name.unique' => 'Пользователь с таким именем уже существует',

            'password.min' => 'Пароль должен содержать минимму из 6 символов',
            'password.max' => 'Пароль должен содержать максимум из 40 символов',
            'password.confirmed' => 'Пароли не совпадают',
        ];
    }
}
