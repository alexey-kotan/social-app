<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\EditProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EditProfileController extends Controller
{
    
    public function avatar(EditProfileRequest $request) {

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

    public function bio(EditProfileRequest $request) {

        // находим авториз.пользователя
        $user = Auth::user();

        // проверка и сохранение био
        $user->bio = $request->input('bio_text');
        $user->save();
        
        return redirect('userpage')->with('success_post', 'БИО отредактированно.');
    }

    public function name(RegisterRequest $request) {

        // находим авториз.пользователя
        $user = Auth::user();

        // проверка и сохранение био
        $user->name = $request->input('name');
        $user->save();
        
        return redirect('userpage')->with('success_post', 'Ваше имя изменено.');
    }
}
