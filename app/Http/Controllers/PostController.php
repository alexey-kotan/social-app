<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function post_create(Request $request){

        $request->validate([
            'post_text' => 'required|string|max:255',
            'post_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120' // валидация изображения
        ]);

        $postData = [
            'user_name' => Auth::user()->name,
            'post_text' => $request->input('post_text'),
        ];

        // Проверка и сохранение изображения
        if ($request->hasFile('post_image')) {
            // Сохранение файла и получение пути
            $imagePath = $request->file('post_image')->store('images', 'public'); // Указываем диск 'public'
            $postData['post_image'] = $imagePath; // Сохраняем путь к изображению в массиве
        }

        Post::create($postData);
        
        return redirect('userpage')->with('success_post', 'Ваш пост успешно опубликован.');
    }

    public function showUserPosts() {
        $user = Auth::user(); // Получаем пользователя

        if (!$user) {
            abort(404); // Если пользователь не найден, возвращаем 404
        }
    
        // Получаем три последних поста пользователя
        $posts = $user->posts()->orderBy('created_at', 'desc')->take(3)->get();
        return view('user.userpage', compact('user', 'posts')); // Передаем данные в представление userpage
    }
}
