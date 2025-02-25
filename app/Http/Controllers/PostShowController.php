<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PostShowController extends Controller
{
    // отобразить последние 3 поста  авториз.пользователя
    public function showLastPosts() {
        $user = Auth::user(); // Получаем пользователя

        if (!$user) {
            abort(404); // Если пользователь не найден, возвращаем 404
        }
        // Получаем три последних поста пользователя
        $posts = $user->posts()->with(['post_likes' => function($query) { // используем жадную загрузку с фильтром $query
            $query->where('user_id', Auth::id()); }]) // загружаем только лайки текущего пользователя
            ->orderBy('created_at', 'desc')->take(3)->get(); // выводим 3 последних поста

        $subscriptionCount = new SubscriptionController()->my_subscribers();

        return view('user.userpage', compact('user', 'posts', 'subscriptionCount')); // передаем данные в представление userpage
    }

    // отобразить все посты авториз.пользователя
    public function showPosts() {
        $user = Auth::user(); // Получаем пользователя

        if (!$user) {
            abort(404); // Если пользователь не найден, возвращаем 404
        }
        // Получаем три последних поста пользователя
        $posts = $user->posts()->with(['post_likes' => function($query) {
            $query->where('user_id', Auth::id());}])
            ->orderBy('created_at', 'desc')->get();
        
        return view('user.my_posts', compact('user', 'posts')); // Передаем данные в представление my_posts
    }
    
    // отобразить все посты всех пользователей
    public function showAllPosts() {
        $user = Post::select('user_id')->distinct()->pluck('user_id');
        $posts = Post::with(['post_likes' => function($query) {
            $query->where('user_id', Auth::id());}])
            ->orderBy('created_at', 'desc')->get();
        
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
        $posts = $user->posts()->with(['post_likes' => function($query) {
            $query->where('user_id', Auth::id());}])
            ->orderBy('created_at', 'desc')->take(3)->get();
        
        $subscriptionCount = new SubscriptionController()->user_subscribers($id);
        
        return view('user.user', compact('user', 'posts', 'subscriptionCount')); // Передаем данные в представление user
    }

    // отобразить все посты другого пользователя
    public function showUserPosts($id) {
        $user = User::find($id); // Получаем пользователя

        if (!$user) {
            abort(404); // Если пользователь не найден, возвращаем 404
        }
        $posts = $user->posts()->with(['post_likes' => function($query) {
            $query->where('user_id', Auth::id());}])
            ->orderBy('created_at', 'desc')->get();
        
        return view('user.user_posts', compact('user', 'posts')); // Передаем данные в представление my_posts
    }

    // обобразить посты пользователей на котроых подписан авториз.пользователь
    public function showSubscriptionsPosts()
    {
        // Получаем всех пользователей, на которых подписан авториз.пользователь
        $subscriptions = Auth::user()->subscriptions;

        // Получаем посты всех подписанных пользователей
        $posts = Post::whereIn('user_id', $subscriptions->pluck('id')) // метод pluck('id') возвращает id всех подписок
            ->with(['post_likes' => function($query) {
            $query->where('user_id', Auth::id());}])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.subscriptions', compact('subscriptions', 'posts'));
    }
}
