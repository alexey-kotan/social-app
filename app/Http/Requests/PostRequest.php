<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'post_text' => 'required|string|max:255',
            'post_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120'
        ];
    }

    public function messages()
    {
        return [
            'post_text.max' => 'Максимальное количество символов 255',

            'post_image.image' => 'Файл должен быть изображением',
            'post_image.mimes' => 'Файл должен быть изображением в формате jpeg | png | jpg | gif',
            'post_image.max' => 'Размер изображения не должен превышать 5 МБ'
        ];
    }
}
