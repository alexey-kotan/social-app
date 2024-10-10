<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegController extends Controller
{
    public function reg(Request $request) {
        $request->validate([
            'name'=>'required|string|min:2|max:20|unique:users,name',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:6|max:40|confirmed'
        ]);

        $user = User::create([ // добавляем данные в БД через модель User
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password
    ]);
        Auth::login($user); // после успешной регистрации, пользователь входит в систему (с данными из $user)
        return redirect('userpage'); // и перенаправляется на страницу пользователя 
    }
}
