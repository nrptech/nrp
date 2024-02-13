<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class LanguageLocale
{
   // LanguageLocale.php
public function handle(Request $request, Closure $next)
{
    if (Auth::check()) {
        $userLanguage = Auth::user()->language;
        App::setLocale($userLanguage);
    } elseif (session()->has('locale')) {
        App::setLocale(session('locale'));
    }

    // Your existing middleware logic

    return $next($request);
}

}