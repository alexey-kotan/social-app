<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Настройка доверенных прокси
        $middleware->trustProxies(at: [
            '192.168.1.1', // Замените на ваши IP-адреса
            '192.168.1.2',
            '*', // Или используйте '*' для доверия всем прокси
        ]);

        // Другие настройки middleware
        $middleware->trustHosts(at: ['yourdomain.com', '*.yourdomain.com']);
        $middleware->alias([
            'active.user' => \App\Http\Middleware\ActiveUserMiddleware::class,
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);
    })
    
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
