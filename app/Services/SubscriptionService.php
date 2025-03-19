<?php

namespace App\Services;

use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class SubscriptionService
{
    public function subscribe($id)
    {
        $checkSubscription = Subscription::where('user_id', Auth::id()) // проверяем, авториз. пользователь не подписан на данного
                            ->where('subscribed_to_id', $id)
                            ->first(); // первая нашедшая запись

        if($checkSubscription) { // если подписка есть
            return true;
        }

        // если подписки нету, создаем новую запись в таблицу
        $subscription = new Subscription();
        $subscription->user_id = Auth::id();
        $subscription->subscribed_to_id = $id;
        $subscription->save();
    }

    public function unsubscribe($id)
    {
        Subscription::where('user_id', Auth::id()) // если есть запись авториз.пользователя с подпиской на данного
                    ->where('subscribed_to_id', $id)
                    ->delete(); // удалить
    }

    public function mySubscribers()
    {
        return Subscription::where('subscribed_to_id', Auth::id())->count();

    }

    public function userSubscribers($id)
    {
        return Subscription::where('subscribed_to_id', $id)->count();
    }
}