<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotRequest;
use App\Services\ForgotService;

class ForgotPassController extends Controller
{
    private ForgotService $forgotService;

    public function __construct(ForgotService $forgotService)
    {
        $this->forgotService = $forgotService;
    }

    public function forgot(ForgotRequest $request) 
    {
        $result = $this->forgotService->forgot($request->only('email')); 
        // only() - создает массив ключ(стока email) - занчение(переданный email пользователем)
        //dd($result);
        
        if($result === true) {
            return back()->with('status', trans('password.send'));
            // в случае успешной отправки возвращаем юзера назад и выводим сообщение об успехе под ключем 'status'
        } else {
            return back()->withInput($request->only('email'))->withErrors(['email' => trans($result)]);
            // в случае неуспеха, возвращаем юзера и выводим сообщение об ошибке email
        }
    }
}