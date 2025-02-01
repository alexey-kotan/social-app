<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Роль
        Blade::if('admin', function () {
            return Auth::user()->role == 'admin';
        }); 
        Blade::if('user', function () {
            return Auth::user()->role == 'user';
        }); 

        //Статус
        Blade::if('active', function () {
            return Auth::user()->status == 'active';
        }); 
        Blade::if('banned', function () {
            return Auth::user()->status == 'ban';
        });
    }
}