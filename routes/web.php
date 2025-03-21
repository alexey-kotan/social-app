<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegController;
use App\Http\Controllers\ForgotPassController;
use App\Http\Controllers\ResetPassController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostShowController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\EditProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LikeController;


// страница faq
Route::view('/faqs', 'pages/faqs')->name('faqs');

// страница о нас
Route::view('/about', 'pages/about')->name('about');

// страница регистрации
Route::view('/reg', 'pages/reg')->middleware('guest')->name('reg');
// контроллер регистрации
Route::post('/reg', [RegController::class, 'reg'])-> name('user-reg');

// страница авторизации (главная)
Route::view('/', 'pages/auth')->middleware('guest')->name('home');
// контроллер авторизации
Route::post('/', [AuthController::class, 'auth'])->name('user-auth');
// Всё что передается через post на странице /auth передается в AuthController в метод auth 
//наименование name('user-auth') для того, чтобы использовать его для отправки в форме

// контроллер выхода из системы
Route::post('/userpage', [AuthController::class, 'logout']) -> middleware('auth') -> name('logout');

// страница сброса пароля
Route::view('/forgot_pass', 'pages/forgot_pass')->middleware('guest')->name('forgot_pass');
// контроллер сброса пароля
Route::post('/forgot_pass', [ForgotPassController::class, 'forgot'])->name('forgot');
// сброс пароля до отправки сообщения
Route::get('/reset_pass', [ResetPassController::class, 'reset'])->name('password.reset');
// сброс пароля после отправки сообщения
Route::post('/reset_pass', [ResetPassController::class, 'update'])->name('password.update');

//ПОЛЬЗОВАТЕЛЬ
// страница пользователя
Route::get('/userpage', [PostShowController::class, 'showLastPosts'])->middleware('auth')->name('userpage');

// доступ только не заблокированным пользователям
Route::middleware(['auth', 'active.user'])->group(function () {
    // страница другого пользователя + отображение 3х последних постов
    Route::get('/id_{id}', [PostShowController::class, 'showLastUserPost'])->name('user_profile');
    // страница поиска пользователей
    Route::get('/search', [SearchController::class, 'userSearch'])->name('user_search');

    //РЕДАКТИРОВАНИЕ ПРОФИЛЯ
    // страница редактирования профиля авториз.пользователя
    Route::view('/edit_profile', 'user/edit_profile')->name('edit_profile');
    // сменить аватар
    Route::post('/edit_profile/avatar', [EditProfileController::class, 'avatar'])->name('edit_avatar');
    // редактировать био
    Route::post('/edit_profile/bio', [EditProfileController::class, 'bio'])->name('edit_bio');
    // редактировать имя
    Route::post('/edit_profile/name', [EditProfileController::class, 'name'])->name('edit_name');

    //ПОСТЫ
    // страница нового поста
    Route::view('/newpost', 'user/newpost')->name('newpost');
    // контроллер создание поста
    Route::post('/newpost', [PostController::class, 'create'])->name('post_create');
    // контроллер удаления поста
    Route::delete('/posts/{id}', [PostController::class, 'delete'])->name('post_delete');
    // страница с постами юзера
    Route::get('/my_posts', [PostShowController::class, 'showPosts'])->name('my_posts');
    // страница с постами всех пользователей
    Route::get('/all_posts', [PostShowController::class, 'showAllPosts'])->name('all_posts');
    // страница всех постов других пользователей
    Route::get('/id_{id}/posts', [PostShowController::class, 'showUserPosts'])->name('user_posts');
    // контроллер лайк на пост
    Route::post('/posts/{id}/like', [LikeController::class, 'post_like'])->name('post_like');

    //ПОДПИСКИ
    // страница мои подписки
    Route::get('/subscriptions', [PostShowController::class, 'showSubscriptionsPosts'])->name('subscriptions');
    // подписаться
    Route::post('/subscribe/id_{id}', [SubscriptionController::class, 'subscribe'])->name('subscribe');
    // Отменить подписку
    Route::post('/unsubscribe/id_{id}', [SubscriptionController::class, 'unsubscribe'])->name('unsubscribe');

    //ПОДПИСЧИКИ
    // страница мои подписчики
    Route::get('/subscribers', [SubscriptionController::class, 'my_subscribers'])->name('subscribers');
    // страница подписчики пользователя
    Route::get('/id_{id}/subscribers', [SubscriptionController::class, 'user_subscribers'])->name('user_subscribers');
});

// доступ только администраторам
Route::middleware(['auth', 'active.user'])->group(function () {
    //АДМИН
    // отображение всех пользователей
    Route::get('/all_users', [AdminController::class, 'all_users'])->name('all_users');
    // блокировка пользователя
    Route::post('/all_users/ban_user', [AdminController::class, 'ban_user'])->name('ban_user');
    // разблокировка пользователя
    Route::post('/all_users/unban_user', [AdminController::class, 'unban_user'])->name('unban_user');
});