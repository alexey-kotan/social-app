<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\SubscriptionService;
use function PHPUnit\Framework\returnArgument;

class PostShowService
{
    private SubscriptionService $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    private function getPostsWithLikes($query) // повторение кода заключаем в отдельный метод
    {
        return $query->with(['post_likes' => function ($query) { // используем жадную загрузку с фильтром $query
            $query->where('user_id', Auth::id()); // загружаем только лайки текущего пользователя
        }]);
    }
    public function showLastPosts()
    {
        $user = Auth::user(); // Получаем пользователя

        if (!$user) {
            abort(404); // Если пользователь не найден, возвращаем 404
        }
        // Получаем три последних поста пользователя
        $posts = $this->getPostsWithLikes($user->posts())
                ->orderBy('created_at', 'desc')->take(3)->get(); // выводим 3 последних поста

        $subscriptionCount = $this->subscriptionService->mySubscribersCount();

        return compact('posts', 'user', 'subscriptionCount');
    }

    public function showPosts()
    {
        $user = Auth::user(); // Получаем пользователя

        if (!$user) {
            abort(404); // Если пользователь не найден, возвращаем 404
        }
        // Получаем три последних поста пользователя
        $posts = $this->getPostsWithLikes($user->posts())
                ->orderBy('created_at', 'desc')->get();
        
                $result = compact('posts', 'user');

                return $result;

    }

    public function showAllPosts()
    {
        $user = Post::select('user_id')->distinct()->pluck('user_id');
        $posts = Post::with(['post_likes' => function($query) {
            $query->where('user_id', Auth::id());}])
            ->orderBy('created_at', 'desc')->get();
        
            $result = compact('posts', 'user');

            return $result;

    }

    public function showLastUserPost($id)
    {
        $user = User::find($id); // Получаем пользователя по его id
        $current_user = Auth::user();
        if (!$user) {
            abort(404); // Если пользователь не найден, возвращаем 404
        }
        elseif ($user->id == auth()->id()) {
            return 'user';
        }
        // Получаем три последних поста пользователя
        $posts = $this->getPostsWithLikes($user->posts())
            ->orderBy('created_at', 'desc')->take(3)->get();
        
        $subscriptionCount = $this->subscriptionService->userSubscribersCount($id);
        
        $result = compact('posts', 'subscriptionCount', 'user');

        return $result;

    }

    public function showUserPosts($id)
    {
        $user = User::find($id); // Получаем пользователя

        if (!$user) {
            abort(404); // Если пользователь не найден, возвращаем 404
        }
        $posts = $this->getPostsWithLikes($user->posts())
            ->orderBy('created_at', 'desc')->get();
        
            $result = compact('posts', 'user');

            return $result;

    }

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
 
             $result = compact('posts', 'subscriptions');

             return $result;

    }
}