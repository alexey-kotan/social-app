<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest; // файл валидации
use App\Services\AuthService; // файл с бизнес логикой
use App\Services\LogoutService; // файл с бизнес логикой

class AuthController extends Controller
{
    private AuthService $authService;
    private LogoutService $logoutService;

    public function __construct(AuthService $authService, LogoutService $logoutService)
    {
        $this->authService = $authService;
        $this->logoutService = $logoutService;
    }

    // авторизация
    public function auth(AuthRequest $request) {
        
        $result = $this->authService->auth($request->all()); // проверяем данные из AuthService

        if($result) { // если $result == true
            return redirect()->route('userpage'); // перенаправляет на страницу пользователя
        } else { // если есть ошибки валидации
            return back()->withInput()->withErrors(['authError' => trans('auth.failed')] );
            // back() - возвращает пользователя на ту же страницу, withInput() - сохраняет данные введенные пользователем в поле (через сессии),
            // withErrors() - сохраняет ошибки из валидации в сессии для дальнейшего вывода на странице
            // trans - хранит заготовленный ответ на ошибку
        }
    }

    // выход из системы
    public function logout(Request $request) {

        $this->logoutService->logout($request);
        return redirect()->route('home'); // перенаправляем на главную страницу
    }
}