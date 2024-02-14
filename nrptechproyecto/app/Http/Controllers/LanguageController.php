<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
    public function switchLanguage(Request $request)
    {
        $user = Auth::user();


        $user->language = $request->language;
        $user->save();


        return redirect()->back();
    }


}
