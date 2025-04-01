<?php

namespace App\Http\Controllers;

use App\Services\PostShowService;
use App\Services\SubscriptionService;

class PostShowController extends Controller
{
    private PostShowService $postShowService;
    private SubscriptionService $subscriptionService;

    public function __construct(PostShowService $postShowService, SubscriptionService $subscriptionService)
    {
        $this->postShowService = $postShowService;
    }

    // отобразить последние 3 поста  авториз.пользователя
    public function showLastPosts() {
        
        $result = $this->postShowService->showLastPosts();

        if ($result == 'user') {
            return redirect()->route('userpage');
        }
        return view('user.userpage', $result); // передаем данные в представление userpage
    }

    // отобразить все посты авториз.пользователя
    public function showPosts() {

        $result = $this->postShowService->showPosts();

        return view('user.my_posts', $result); // Передаем данные в представление my_posts
    }
    
    // отобразить все посты всех пользователей
    public function showAllPosts() {

        $result = $this->postShowService->showAllPosts();
        
        return view('user.all_posts', $result); // Передаем данные в представление all_posts
    }

    // отобразить послежние посты другого пользователя
    public function showLastUserPost($id){

        $result = $this->postShowService->showLastUserPost($id);
        
        return view('user.user', $result); // Передаем данные в представление user
    }

    // отобразить все посты другого пользователя
    public function showUserPosts($id) {
        
        $result = $this->postShowService->showUserPosts($id);
        
        return view('user.user_posts', $result); // Передаем данные в представление user_posts
    }

    // обобразить посты пользователей на котроых подписан авториз.пользователь
    public function showSubscriptionsPosts()
    {
        $result = $this->postShowService->showSubscriptionsPosts();

        return view('user.subscriptions', $result);
    }
}
