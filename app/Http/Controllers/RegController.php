<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\RegService;

class RegController extends Controller
{
    private RegService $regService;

    public function __construct(RegService $regService) 
    {
        $this -> regService = $regService;
    }

    // регистрация
    public function reg(RegisterRequest $request) {
    // валидация в файле RegisterRequest.php
        $user = $this->regService->reg($request->all()); 
        // берем данные из конструктора, и используем метод reg из сервиса RegService над данными, переданными из представления $request->all()
        
        return redirect('userpage'); // и перенаправляется на страницу пользователя 
    }
}
