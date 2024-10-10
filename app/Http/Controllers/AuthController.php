<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\User;
use Illuminate\Support\Facades\Auth; // Подключение фасада Auth для исполльзования attempt

class AuthController extends Controller
{
    public function auth(Request $request) {

        $request->validate([ //проверяем валидацию
            'email' => 'required|email', // required - поле не пустое
            'password' => 'required|string'
        ]);

        $credentials = $request->only('email', 'password'); // получаем только необходимые поля из запроса $request и заносим в переменную 
        $remember = $request->has('remember'); // получаем данные о чекбоксе запомни меня и добавляем значекние bool в переменную

        if (Auth::attempt($credentials, $remember)) { // attempt сверяет данные из переменной credentials с данными в БД
            // пароль сравнивает только в зашифрованном 'Bcrypt' виде
            // проверяется занчение remember, если true, то remember_token добавляется в БД и запоминает позьзователя в системе
            return redirect()->route('userpage'); // перенаправляет на страницу пользователя
        } else {
            return back()->withInput()->withErrors(['email' => trans('auth.failed')]);
        // back() - возвращает пользователя на ту же страницу, withInput() - сохраняет данные введенные пользователем в поле (через сессии),
        // withErrors() - сохраняет ошибки из валидации в сессии для дальнейшего вывода на странце
        // trans - хранит заготовленный ответ на ошибку
        }
    }

    public function logout(Request $request) {
        Auth::logout(); // logout удаляет сессию пользователя из куки
        $request->session()->invalidate(); // удаляет все данные из сессии (для безопасности)
        $request->session()->regenerateToken(); // меняет csrf токен (для безопасности)
        return redirect()->route('home'); // перенаправляем на главную страницу
    }
}