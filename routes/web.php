<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegController;
use App\Http\Controllers\ForgotPassController;
use App\Http\Controllers\ResetPassController;

// домащняя
// Route::get('/q', function () { 
// return view('pages/home'); }) -> middleware('guest')
//     -> name('home');

// faq
Route::get('/faqs', function () { 
return view('pages/faqs'); })
    -> name('faqs');

// о нас
Route::get('/about', function () { 
return view('pages/about'); })
    -> name('about');

// страница регистрации
Route::get('/reg', function () { 
return view('pages/reg'); }) -> middleware('guest')
    -> name('reg');
// контроллер регистрации
Route::post('/reg', [RegController::class, 'reg'])-> name('user-reg');

// страница авторизации
Route::get('/', function () { 
return view('pages/auth'); }) -> middleware('guest')
    -> name('home');
// контроллер авторизации
Route::post('/', [AuthController::class, 'auth'])-> name('user-auth');
// Всё что передается через post на странице /auth передается в AuthController в метод auth 
//наименование name('user-auth') для того, чтобы использовать его для отправки в форме

// контроллер выхода из системы
Route::post('/userpage', [AuthController::class, 'logout']) -> middleware('auth') -> name('logout');

// страница сброса пароля
Route::get('/forgot_pass', function () { 
    return view('pages/forgot_pass'); }) -> middleware('guest')
        -> name('forgot_pass');
// контроллер сброса пароля
Route::post('/forgot_pass', [ForgotPassController::class, 'forgot'])-> name('forgot');
// сброс пароля до отправки сообщения
Route::get('/reset_pass', [ResetPassController::class, 'reset'])-> name('password.reset');
// сброс пароля после отправки сообщения
Route::post('/reset_pass', [ResetPassController::class, 'update'])-> name('password.update');


// страница пользователя
Route::get('/userpage', function () { 
return view('user/userpage'); }) -> middleware('auth')
    -> name('userpage');
    