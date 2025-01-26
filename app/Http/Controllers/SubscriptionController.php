<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    // подписка
    public function subscribe($id) {

        $checkSubscription = Subscription::where('user_id', Auth::id()) // проверяем, авториз. пользователь не подписан на данного
        ->where('subscribed_to_id', $id)
        ->first(); // первая нашедшая запись

        if($checkSubscription) { // если подписка есть
            return redirect()->back()->with('success_subscribe', 'Вы уже подписаны.');
        }

        // если подписки нету, создаем новую запись в таблицу
        $subscription = new Subscription();
        $subscription->user_id = Auth::id();
        $subscription->subscribed_to_id = $id;
        $subscription->save();

        return redirect()->back()->with('success_subscribe', 'Вы подписались.');
    }

    // отписка (удаление записи подписки из таблицы)
    public function unsubscribe($id) {

        Subscription::where('user_id', Auth::id()) // если есть запись авториз.пользователя с подпиской на данного
            ->where('subscribed_to_id', $id)
            ->delete(); // удалить

        return redirect()->back()->with('success_subscribe', 'Подписка отменена.');
    }

    // отображение числа подписчиков у нас
    public function my_subscribers() {
        $subscribers = Subscription::where('subscribed_to_id', Auth::id())->count();
        return $subscribers;
    }
    public function user_subscribers($id) {
        $subscribers = Subscription::where('subscribed_to_id', $id)->count();
        return $subscribers;
    }
    
}
