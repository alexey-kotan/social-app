<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EditProfileService
{
    public function avatar(Request $request)
    {
        $user = Auth::user();

        // Проверка и сохранение изображения
        if ($request->hasFile('avatar_image')) {
            // Сохранение файла и получение пути
            $imagePath = $request->file('avatar_image')->store('images', 'public'); // Указываем диск 'public'
            
            $user->avatar = $imagePath; // обновляем столбец avatar и прописываем туда путь из $imagePath
            $user->save();
        }
    }

    public function bio(Request $request)
    {
        // находим авториз.пользователя
        $user = Auth::user();

        // проверка и сохранение био
        $user->bio = $request->input('bio_text');
        $user->save();
    }

    public function name(Request $request)
    {
        // находим авториз.пользователя
        $user = Auth::user();

        // проверка и сохранение имени
        $user->name = $request->input('name');
        $user->save();
    }
}