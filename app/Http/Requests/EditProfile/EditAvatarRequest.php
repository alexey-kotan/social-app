<?php

namespace App\Http\Requests\EditProfile;

use Illuminate\Foundation\Http\FormRequest;

class EditAvatarRequest extends FormRequest
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
            'avatar_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120' // валидация изображения
        ];
    }

    public function messages()
    {
        return [
            'avatar_image.required' => 'Загрузите изображение',
            'avatar_image.image' => 'Файл должен быть изображением',
            'avatar_image.mimes' => 'Файл должен быть изображением в формате jpeg | png | jpg | gif',
            'avatar_image.max' => 'Размер изображения не должен превышать 5 МБ'
        ];
    }
}
