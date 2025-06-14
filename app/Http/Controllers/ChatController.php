<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Events\NewMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index($userId)
    {
        $user = User::findOrFail($userId);
        $messages = Message::where(function($query) use ($userId) {
            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $userId);
        })->orWhere(function($query) use ($userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        return view('user.chat', compact('user', 'messages'));
    }

    public function sendMessage(Request $request, $userId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $userId,
            'message' => $request->message,
        ]);

        // Загружаем отношения, если они нужны для отображения
        $message->load('sender');

        broadcast(new NewMessage($message))->toOthers();

        return redirect()->back();
    }

    public function getMessages($userId)
    {
        $messages = Message::where(function($query) use ($userId) {
            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $userId);
        })->orWhere(function($query) use ($userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        return response()->json($messages);
    }
}
