<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Services\SubscriptionService;
use Illuminate\Support\Facades\Auth;

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
    public function my_subscribers() {

        return $this->subscriptionService->mySubscribers();
    }

    // отображение числа подписчиков у пользователя
    public function user_subscribers($id) {

        return $this->subscriptionService->userSubscribers($id);
    }
    
}
