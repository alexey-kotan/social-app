<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;

class FriendController extends Controller
{
    public function sendFriendRequest(Request $request, $friendId) {
        
        $userId = auth()->Id(); // находим id текущего пользователя

        if($userId == $friendId) { // проверяем, чтобы текущий пользователь не был самим собой
            return response()->json(['massage' => 'Это Вы. Вы не можете добавить себя в друзья :('], 400);
        }

        // проверяем, есть ли уже запрос на дружбу
        $existingRequest = Friend::where('user_id', $userId)
                                ->where('friend-id', $friendId)
                                ->first();

        if($existingRequest) { 
            return response()->json(['massage' => 'Вы уже отправили запрос на дружбу :)']);
        }

        Friend::create([ // создаем новый запрос на дружбу
            'user_id' => $userId,
            'firend_id' => $friendId,
            'status' => 'pending',
        ]);

        return response()->json(['massage' => 'Запрос на дружбу отправлен. Ожидайте подтверждения!']);
    }

    public function acceptFriendRequest($friendId){

        $userId = auth()->id();

        $friendRequest = Friend::where('user_id', $friendId)
                                ->where('friend_id', $userId)
                                ->where('status', 'pending')
                                ->first();
    
        if(!$friendRequest) {
            return response()->json(['massage' => 'Запрос на дружбу не найден.'], 404);
        }

        $friendRequest->status = 'accepted';
        $friendRequest->save();

        return response()->json(['massage' => 'Запрос на дружбу принят :)']);
    }

    public function declineFriendRequest($friendId) {

        $userId = auth()->id();

        $friendRequest = Friend::where('user_id', $friendId)
        ->where('friend_id', $userId)
        ->where('status', 'pending')
        ->first();

        if(!$friendRequest) {
            return response()->json(['massage' => 'Запрос на дружбу не найден.'], 404);
        }

        $friendRequest->delete();

        return response()->json(['massage' => 'Запрос на дружбу отклонен.']);
    }
}
