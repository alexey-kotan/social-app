<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    // создать пост
    public function create(PostRequest $request){
        // добавляем в массив postData id авториз.пользователя
        $postData = [
            'user_id'=> Auth::id(),
            'post_text' => $request->post_text
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

    public function delete($id) {
        // находим пост по его id
        $post = Post::find($id);
        // если id поста не найдено
        if(!$post) {
            return redirect()->back();
        }

        $post->delete();

        return redirect()->back()->with('success_post', 'Пост успешно удален.');

    }
}
