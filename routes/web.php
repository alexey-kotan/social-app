<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegController;
use App\Http\Controllers\ForgotPassController;
use App\Http\Controllers\ResetPassController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;


// страница faq
Route::get('/faqs', function () { 
return view('pages/faqs'); })
    -> name('faqs');

// страница о нас
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
Route::get('/userpage', [PostController::class, 'showLastPosts']) -> middleware('auth') -> name('userpage');

//ДРУЗЬЯ
// страница мои друзья
Route::get('/friends', function () { 
    return view('user/friends'); }) -> middleware('auth')
        -> name('friends');
// отправка запроса на дружьбу
Route::post('/friends/{friendId}', [FriendController::class, 'sendFriendRequest'])->middleware('auth');
// страница другого пользователя + отображение 3х последних постов
Route::get('/id_{id}', [PostController::class, 'showLastUserPost'])->name('user_profile');

//ПОСТЫ
// страница нового поста
Route::get('/newpost', function () { 
    return view('user/newpost'); }) -> middleware('auth')
        -> name('newpost');
// контроллер новый пост
Route::post('/newpost', [PostController::class, 'post_create'])-> name('post_create');
// страница с постами юзера
Route::get('/my_posts', [PostController::class, 'showPosts']) -> middleware('auth') -> name('my_posts');
// страница с постами всех пользователей
Route::get('/all_posts', [PostController::class, 'showAllPosts']) -> middleware('auth') -> name('all_posts');
// страница всех постов других пользователей
Route::get('/id_{id}/posts', [PostController::class, 'showUserPosts'])->name('user_posts');