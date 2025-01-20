<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Password;
use App\Models\User;

class ResetPassController extends Controller
{
    public function reset(Request $request) {

        return view('pages.reset_pass', ['request' => $request]); 
        // переносит на представление pages.reset_pass из письма о сбросе пароля
        // второй аргумент передает данные(допустим о email) в $request для использования в представлении reset_pass
    }

    public function update(Request $request){
        $request->validate([
            'password'=>'required|string|min:6|max:40|confirmed'
        ]); // валидация нового пароля + повтор пароля

        $user = User::where('email', $request->email)->first();
        // проверяет есть ли в БД переданный email и при первом нахождении(first) передает его в объект $user

        $user->update([ // обновление пароля + хеширование
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('home')->with('success', 'Ваш пароль успешно обновлен');
        // после смены пароля перенаправление пользователя на страницу входа с сообщение об успехе
    }
}