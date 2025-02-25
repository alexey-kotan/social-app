<?php

namespace App\Services\EditProfile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AvatarService
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
}