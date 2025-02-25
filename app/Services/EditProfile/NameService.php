<?php

namespace App\Services\EditProfile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NameService
{
    public function name(Request $request)
    {
        // находим авториз.пользователя
        $user = Auth::user();

        // проверка и сохранение имени
        $user->name = $request->input('name');
        $user->save();
    }
}