<?php

namespace App\Http\Requests\EditProfile;

use Illuminate\Foundation\Http\FormRequest;

class EditNameRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:20|unique:users,name|regex:/^(?! )[a-zA-Z0-9]+(?: [a-zA-Z0-9]+)*(?<! )$/'
        ];
    }

    public function messages()
    {
        return [
            'name.regex' => 'Имя может содержать только английские буквы и цифры, не может содержать более одного пробела подряд и не может начинаться или заканчиваться пробелами.',
            'name.min' => 'Имя должно содержать минимму из 2 символов',
            'name.max' => 'Имя должно содержать максимум из 20 символов',
            'name.unique' => 'Пользователь с таким именем уже существует'
        ];
    }
}
