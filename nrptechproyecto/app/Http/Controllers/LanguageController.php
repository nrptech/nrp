<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Http\RedirectResponse;
class LanguageController extends Controller
{
    public function switchLanguage(Request $request)
    {
        
        $language = $request->language;

        if (Auth::check()) {
            // Caso en estar registrado
            $user = Auth::user();
            $user->language = $language;
            $user->save();
        } else {
            // Caso en no estar registrado
            Session::put('language', $language);    
           
        }
        return redirect()->back();
    }
}

