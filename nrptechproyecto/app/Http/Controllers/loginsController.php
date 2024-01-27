<?php

namespace App\Http\Controllers;
use App\Models\Login;
use Illuminate\Http\Request;

class loginsController extends Controller
{
    public function logins()
    {
        $logins = Login::all();
        return view('logins', @compact('logins'));
    }

}
