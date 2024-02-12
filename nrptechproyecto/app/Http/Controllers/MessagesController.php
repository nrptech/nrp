<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function store()
    {
        request()->validate([
        'name' => 'required',
        'email' => 'required|email',
        'subject' => 'required',
        'content' => 'required|min:3'
        ],[
            'name.required' => 'necesito tu nombre'
        ]);
        
        return 'datos validados';
    }
}
