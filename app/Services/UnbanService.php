<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UnbanService
{
    public function unban_user(Request $request)
    {
        $userId = $request->input('user_id');

        $user = User::find($userId);
        
        $user->status = 'active';
        $user->avatar = 'default.png';
        $user->save();
    }
}