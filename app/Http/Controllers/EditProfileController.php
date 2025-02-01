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

    public function bio(Request $request) {

        $request->validate([
            'bio_text' => 'required|string|max:450',
        ]);

        // находим авториз.пользователя
        $user = Auth::user();

        // проверка и сохранение био
        $user->bio = $request->input('bio_text');
        $user->save();
        
        return redirect('edit_profile')->with('success_edit', 'БИО отредактированно.');
    }

    public function name(Request $request) {

        $request->validate([
            'name' =>'required|string|min:2|max:20|unique:users,name|regex:/^(?! )[a-zA-Z0-9]+(?: [a-zA-Z0-9]+)*(?<! )$/',
        ],
[
            'name.regex' => 'Имя может содержать только английские буквы и цифры, не может содержать более одного пробела подряд и не может начинаться или заканчиваться пробелами.',
        ]);

        // находим авториз.пользователя
        $user = Auth::user();

        // проверка и сохранение био
        $user->name = $request->input('name');
        $user->save();
        
        return redirect('edit_profile')->with('success_edit', 'Ваше имя изменено.');
    }
}
