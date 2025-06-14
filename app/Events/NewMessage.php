<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        // Создаем общий канал для обоих пользователей
        $ids = [$this->message->sender_id, $this->message->receiver_id];
        sort($ids); // Сортируем для единообразия
        
        return new PrivateChannel('chat.'.$ids[0].'.'.$ids[1]);
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message->load('sender')
        ];
    }
}
