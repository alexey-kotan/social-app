<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class AdminController extends Controller
{
    // отобразить всех пользователей
    public function all_users() {
        // данные пользователя
        $user = User::select('id', 'avatar', 'name', 'email', 'role', 'status', 'created_at')
                ->orderBy('created_at', 'desc')
                ->get();
        
        return view('admin.all_users', compact('user')); // Передаем данные в представление
    }

    // заблокировать пользователя (бан)
    public function ban_user(Request $request) {
        
        $userId = $request->input('user_id');

        $user = User::find($userId);

        $user->status = 'ban';
        $user->avatar = 'banned.png';
        $user->bio = null;
        $user->save();

        $user->posts()->delete();
        
        return redirect()->back()->with('success', 'Пользователь заблокирован. Все посты пользователя были удалены');
    }

    // разблокировать пользователя
    public function unban_user(Request $request) {
        $userId = $request->input('user_id');

        $user = User::find($userId);
        
        $user->status = 'active';
        $user->avatar = 'default.png';
        $user->save();
        
        return redirect()->back()->with('success', 'Пользователь разблокирован.');
    }
}

