<?php

namespace App\Http\Controllers;

use App\Services\SubscriptionService;

class SubscriptionController extends Controller
{
    private SubscriptionService $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    // подписка
    public function subscribe($id) {

        $this->subscriptionService->subscribe($id);
        
        return redirect()->back()->with('success_subscribe', 'Вы подписались.');
    }

    // отписка (удаление записи подписки из таблицы)
    public function unsubscribe($id) {

        $this->subscriptionService->unsubscribe($id);

        return redirect()->back()->with('success_subscribe', 'Подписка отменена.');
    }

    // отображение числа подписчиков у авториз.пользователя
    public function my_subscribers_count() {

        return $this->subscriptionService->mySubscribersCount();
    }

    // отображение числа подписчиков у пользователя
    public function user_subscribers_count($id) {

        return $this->subscriptionService->userSubscribersCount($id);
    }
    
    public function my_subscribers() {

        $subscribers = $this->subscriptionService->mySubscribers();
        return view('user.subscribers', compact('subscribers'));
    }

    public function user_subscribers($id) {

        $user_subscribers = $this->subscriptionService->userSubscribers($id);
        return view('user.user_subscribers', compact('user_subscribers'));
    }
}
