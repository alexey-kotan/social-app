<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth; // Подключение фасада Auth для исполльзования attempt
use Illuminate\Http\Request;

class AuthService
{
    public function auth(array $data)
    {
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password'],
        ]; // получаем только необходимые поля из запроса $data (которая будет брать данные из $request в контрллере) и заносим в переменную 
        
        $remember = $data['remember'] ?? false; // получаем данные о чекбоксе запомни меня и добавляем значекние bool в переменную

        if (Auth::attempt($credentials, $remember)) { // attempt сверяет данные из переменной credentials с данными в БД
            // пароль сравнивает только в зашифрованном 'Bcrypt' виде
            // проверяется занчение remember, если true, то remember_token добавляется в БД и запоминает позьзователя в системе
            return true;
        } else {
            return false;
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); // logout удаляет сессию пользователя из куки
        $request->session()->invalidate(); // удаляет все данные из сессии (для безопасности)
        $request->session()->regenerateToken(); // меняет csrf токен (для безопасности)

    }
}