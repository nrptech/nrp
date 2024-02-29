<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class LanguageLocale
{

   public function handle(Request $request, Closure $next)
   {
       if (Auth::check() && Auth::user()->language) {
           $userLanguage = Auth::user()->language;
           App::setLocale($userLanguage);
       } elseif (session()->has('locale')) {
           App::setLocale(session()->get('locale'));
       } else {
           
           $browserLanguage = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
           App::setLocale($browserLanguage);
       }
   
       return $next($request);
   }
   

}