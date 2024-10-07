<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auth;

class AuthController extends Controller
{
    public function auth(Request $request) {
        $request->validate([ //проверяем валидацию
            'email' => 'required|email', // required - поле не пустое
            'password' => 'required|string'
        ]);

        $email = $request->input('email'); // после проверки считываем данные из поля и добавлем в переменную
        $password = $request->input('password');

        $userEmail = Auth::where('email', $email)->exists(); // стравниваем значение из таблицы users 
        // (через модель Auth, который копирует User) и занчение из нашей переменной
        // exists() - проверяет, есть ли такое значение в аблице и возвращает true или false
        $userPassword = Auth::where('password', $password)->exists();
 
        if ($userEmail && $userPassword) {
            return redirect()->route('userpage');
        } else {
            return back()->withInput()->withErrors('Такого пользователя не существует! Проверьте данные или зарегистрируйтесь.');
        // back() - возвращает польщователя на ту же страницу, withInput() - созраняет данные введенные пользователем в поле (через сессии),
        // withErrors() - сохраняет ошибки из валидации в сессии для дальнейшего вывода на странце
        }
    }
}
