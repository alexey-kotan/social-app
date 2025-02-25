<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class BanService
{
    public function ban_user(Request $request)
    {
        $userId = $request->input('user_id');

        $user = User::find($userId);

        $user->status = 'ban';
        $user->avatar = 'banned.png';
        $user->bio = null;
        $user->save();

        $user->posts()->delete();
    }
}