<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    // создать пост
    public function post_create(Request $request){

        $request->validate([
            'post_text' => 'required|string|max:255',
            'post_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120' // валидация изображения
        ], [
            'post_image.image' => 'Файл должен быть изображением',
            'post_image.mimes' => 'Файл должен быть изображением в формате jpeg | png | jpg | gif',
            'post_image.max' => 'Размер изображения не должен превышать 5 МБ'
        ]);

        $postData = [
            'user_id' => Auth::user()->id,
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

    // отобразить последние 3 поста  авториз.пользователя
    public function showLastPosts() {
        $user = Auth::user(); // Получаем пользователя

        if (!$user) {
            abort(404); // Если пользователь не найден, возвращаем 404
        }
        // Получаем три последних поста пользователя
        $posts = $user->posts()->with('user')->orderBy('created_at', 'desc')->take(3)->get();
        return view('user.userpage', compact('user', 'posts')); // Передаем данные в представление userpage
    }

    // отобразить все посты авториз.пользователя
    public function showPosts() {
        $user = Auth::user(); // Получаем пользователя

        if (!$user) {
            abort(404); // Если пользователь не найден, возвращаем 404
        }
        // Получаем три последних поста пользователя
        $posts = $user->posts()->orderBy('created_at', 'desc')->get();
        return view('user.my_posts', compact('user', 'posts')); // Передаем данные в представление my_posts
    }
    
    // отобразить все посты всех пользователей
    public function showAllPosts() {
        $user = Post::select('user_id')->distinct()->pluck('user_id');
        // Получаем три последних поста пользователя
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('user.all_posts', compact('user', 'posts')); // Передаем данные в представление my_posts
    }

    // отобразить послежние посты другого пользователя
    public function showLastUserPost($id){
        $user = User::find($id); // Получаем пользователя по его id
        $current_user = Auth::user();
        if (!$user) {
            abort(404); // Если пользователь не найден, возвращаем 404
        }
        elseif ($user == $current_user) {
            return redirect('userpage');
        }
        // Получаем три последних поста пользователя
        $posts = $user->posts()->orderBy('created_at', 'desc')->take(3)->get();
        return view('user.user', compact('user', 'posts')); // Передаем данные в представление user
    }

        // отобразить все посты другого пользователя
        public function showUserPosts($id) {
            $user = User::find($id); // Получаем пользователя
    
            if (!$user) {
                abort(404); // Если пользователь не найден, возвращаем 404
            }
            // Получаем три последних поста пользователя
            $posts = $user->posts()->orderBy('created_at', 'desc')->get();
            return view('user.user_posts', compact('user', 'posts')); // Передаем данные в представление my_posts
        }

        public function showSubscriptionsPosts()
        {
            // Получаем всех пользователей, на которых подписан авториз.пользователь
            $subscriptions = Auth::user()->subscriptions;

            // Получаем посты всех подписанных пользователей
            $posts = Post::whereIn('user_id', $subscriptions->pluck('id')) // метод pluck('id') возвращает id всех подписок
                ->orderBy('created_at', 'desc')
                ->get();

            return view('user.subscriptions', compact('subscriptions', 'posts'));
        }
}
