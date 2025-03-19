<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;

class ResetPassController extends Controller
{
    public function reset(Request $request) {

        return view('pages.reset_pass', ['request' => $request]); 
        // переносит на представление pages.reset_pass из письма о сбросе пароля
        // второй аргумент передает данные(допустим о email) в $request для использования в представлении reset_pass
    }

    public function update(RegisterRequest $request){

        $user = User::where('email', $request->email)->first();
        // проверяет есть ли в БД переданный email и при первом нахождении(first) передает его в объект $user

        $user->updatePassword($request->password);
        // хеширование и сохранения пароля в модели User

        return redirect()->route('home')->with('success', 'Ваш пароль успешно обновлен');
        // после смены пароля перенаправление пользователя на страницу входа с сообщение об успехе
    }
}