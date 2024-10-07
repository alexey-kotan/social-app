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

        if (Auth::attempt($credentials)) { // attempt сверяет данные из переменной credentialsс данными в БД
            // пароль сравнивает только в зашифрованном 'Bcrypt' виде
            redirect()->route('userpage'); // перенаправляет на страницу пользователя
        } else {
            return back()->withInput()->withErrors('Такого пользователя не существует! Проверьте данные или зарегистрируйтесь.');
        // back() - возвращает пользователя на ту же страницу, withInput() - сохраняет данные введенные пользователем в поле (через сессии),
        // withErrors() - сохраняет ошибки из валидации в сессии для дальнейшего вывода на странце
        }
    }
}