<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LogoutService
{
    public function logout(Request $request)
    {
        Auth::logout(); // logout удаляет сессию пользователя из куки
        $request->session()->invalidate(); // удаляет все данные из сессии (для безопасности)
        $request->session()->regenerateToken(); // меняет csrf токен (для безопасности)

    }
}