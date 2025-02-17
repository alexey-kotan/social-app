<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Password;

class ForgotPassController extends Controller
{
    public function forgot(Request $request) {

        $request->validate([ //проверяем валидацию
            'email' => 'required|email', // required - поле не пустое
        ]);
    
        $status = Password::sendResetLink(
        // Метод возвращает статус операции в виде строки, например 'Password::RESET_LINK_SENT', если ссылка была успешно отправлена.
        $request->only('email') // only() - создает массив ключ(стока email) - занчение(переданный email пользователем)
        );
    
        if($status == Password::RESET_LINK_SENT){
            return back()->with('status', trans($status));
            // в случае успешной отправки возвращаем юзера назад и выводим сообщение об успехе под ключем 'status'
        }
        else {
            return back()->withInput($request->only('email'))->withErrors(['email' => trans($status)]);
            // в случае неуспеха, возвращаем юзера и выводим сообщение об ошибке email
        }
    }
}