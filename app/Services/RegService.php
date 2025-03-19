<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegService
{
    public function reg(array $data)
    {
        $user = User::create([ // добавляем данные в БД через модель User
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']) // хешируем пароль
        ]);

        Auth::login($user); // после успешной регистрации, пользователь входит в систему (с данными из $user)

        return $user; // отправляем данные в конттроллер RegController
    }
}