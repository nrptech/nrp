<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLanguage(Request $request, $language)
    {
        // Validate that the requested language is supported
        $supportedLanguages = ['es', 'en'];
        if (!in_array($language, $supportedLanguages)) {
            abort(400, 'Invalid language');
        }

        // Set the application locale to the requested language
        App::setLocale($language);

        // Store the language preference in the session
        Session::put('locale', $language);

        // Redirect back to the previous page or any specific page
        return redirect()->back();
    }
}
