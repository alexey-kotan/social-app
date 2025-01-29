<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegController;
use App\Http\Controllers\ForgotPassController;
use App\Http\Controllers\ResetPassController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\EditProfileController;


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
return view('pages/reg');})->middleware('guest')
    -> name('reg');
// контроллер регистрации
Route::post('/reg', [RegController::class, 'reg'])-> name('user-reg');

// страница авторизации
Route::get('/', function () { 
return view('pages/auth');})->middleware('guest')
    -> name('home');
// контроллер авторизации
Route::post('/', [AuthController::class, 'auth'])->name('user-auth');
// Всё что передается через post на странице /auth передается в AuthController в метод auth 
//наименование name('user-auth') для того, чтобы использовать его для отправки в форме

// контроллер выхода из системы
Route::post('/userpage', [AuthController::class, 'logout']) -> middleware('auth') -> name('logout');

// страница сброса пароля
Route::get('/forgot_pass', function () { 
    return view('pages/forgot_pass'); }) -> middleware('guest')
        -> name('forgot_pass');
// контроллер сброса пароля
Route::post('/forgot_pass', [ForgotPassController::class, 'forgot'])->name('forgot');
// сброс пароля до отправки сообщения
Route::get('/reset_pass', [ResetPassController::class, 'reset'])->name('password.reset');
// сброс пароля после отправки сообщения
Route::post('/reset_pass', [ResetPassController::class, 'update'])->name('password.update');

//ПОЛЬЗОВАТЕЛЬ
// страница пользователя
Route::get('/userpage', [PostController::class, 'showLastPosts'])->middleware('auth')->name('userpage');
// страница другого пользователя + отображение 3х последних постов
Route::get('/id_{id}', [PostController::class, 'showLastUserPost'])->middleware('auth')->name('user_profile');
// страница поиска пользователей
Route::get('/search', [SearchController::class, 'userSearch'])->middleware('auth')->name('user_search');

//РЕДАКТИРОВАНИЕ ПРОФИЛЯ
// страница редактирования профиля авториз.пользователя
Route::get('/edit_profile', function () { 
    return view('user/edit_profile'); }) -> middleware('auth')
        -> name('edit_profile');
// сменить аватар
Route::post('/edit_profile/avatar', [EditProfileController::class, 'avatar'])->middleware('auth')->name('edit_avatar');
// редактировать био
Route::post('/edit_profile/bio', [EditProfileController::class, 'bio'])->middleware('auth')->name('edit_bio');
// редактировать имя
Route::post('/edit_profile/name', [EditProfileController::class, 'name'])->middleware('auth')->name('edit_name');

//ПОСТЫ
// страница нового поста
Route::get('/newpost', function () { 
    return view('user/newpost'); }) -> middleware('auth')
        -> name('newpost');
// контроллер создание поста
Route::post('/newpost', [PostController::class, 'create'])->middleware('auth')->name('post_create');
// контроллер удаления поста
Route::delete('/posts/{id}', [PostController::class, 'delete'])->middleware('auth')->name('post_delete');
// страница с постами юзера
Route::get('/my_posts', [PostController::class, 'showPosts']) ->middleware('auth')->name('my_posts');
// страница с постами всех пользователей
Route::get('/all_posts', [PostController::class, 'showAllPosts'])->middleware('auth')->name('all_posts');
// страница всех постов других пользователей
Route::get('/id_{id}/posts', [PostController::class, 'showUserPosts'])->middleware('auth')->name('user_posts');
// контроллер лайк на пост
Route::post('/posts/{id}/like', [PostController::class, 'post_like'])->middleware('auth')->name('post_like');

//ПОДПИСКИ
// страница мои подписки
Route::get('/subscriptions', [PostController::class, 'showSubscriptionsPosts'])->middleware('auth')->name('subscriptions');

// подписаться
Route::post('/subscribe/id_{id}', [SubscriptionController::class, 'subscribe'])->middleware('auth')->name('subscribe');

// Отменить подписку
Route::post('/unsubscribe/id_{id}', [SubscriptionController::class, 'unsubscribe'])->middleware('auth')->name('unsubscribe');