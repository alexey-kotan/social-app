<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;

class RegController extends Controller
{
    public function reg(RegisterRequest $request) {
    // валидация в файле RegisterRequest.php
        $user = User::create([ // добавляем данные в БД через модель User
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password
    ]);
        Auth::login($user); // после успешной регистрации, пользователь входит в систему (с данными из $user)
        return redirect('userpage'); // и перенаправляется на страницу пользователя 
    }
}
