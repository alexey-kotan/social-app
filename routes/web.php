<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegController;

// Pages
Route::get('/', function () { 
return view('pages/home'); })
    -> name('home');

Route::get('/faqs', function () { 
return view('pages/faqs'); })
    -> name('faqs');

Route::get('/about', function () { 
return view('pages/about'); })
    -> name('about');

// Authentication
Route::get('/reg', function () { 
return view('pages/reg'); }) -> middleware('guest')
    -> name('reg');

Route::get('/auth', function () { 
return view('pages/auth'); }) -> middleware('guest')
    -> name('auth');

Route::post('/auth', [AuthController::class, 'auth'])-> name('user-auth');
// Всё что передается через post на странице /auth передается в AuthController в метод auth 
//наименование name('user-auth') для того, чтобы использовать его для отправки в форме

Route::post('/reg', [RegController::class, 'reg'])-> name('user-reg');

// User
Route::get('/userpage', function () { 
return view('user/userpage'); }) -> middleware('auth')
    -> name('userpage');
    