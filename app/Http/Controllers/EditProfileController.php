<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class EditProfileController extends Controller
{
    public function avatar(Request $request) {

        $request->validate([
            'avatar_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120' // валидация изображения
        ], [
            'avatar_image.required' => 'Загрузите изображение',
            'avatar_image.image' => 'Файл должен быть изображением',
            'avatar_image.mimes' => 'Файл должен быть изображением в формате jpeg | png | jpg | gif',
            'avatar_image.max' => 'Размер изображения не должен превышать 5 МБ'
        ]);

        $user = Auth::user();

        // Проверка и сохранение изображения
        if ($request->hasFile('avatar_image')) {
            // Сохранение файла и получение пути
            $imagePath = $request->file('avatar_image')->store('images', 'public'); // Указываем диск 'public'
            
            $user->avatar = $imagePath; // обновляем столбец avatar и прописываем туда путь из $imagePath
            $user->save();
        }

        return redirect('edit_profile')->with('success_edit', 'Ваш аватар успешно обновлен.');
    }
}
