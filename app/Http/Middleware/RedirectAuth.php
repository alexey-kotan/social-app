<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectAuth
{
    // public function handle($request, Closure $next)
    // {
    //     if (Auth::check()) {
    //         return redirect()->route('userpage', ['id' => Auth::user()->id]);
    //     }

    //     return $next($request);
    // }
}
