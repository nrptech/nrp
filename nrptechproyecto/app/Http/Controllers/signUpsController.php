<?php

namespace App\Http\Controllers;
use App\Models\SignUp;
use Illuminate\Http\Request;

class signUpsController extends Controller
{
    public function signUps()
    {
        $signUps = SignUp::all();
        return view('signUps', @compact('signUps'));
    }

    public function crear(Request $request)
    {
        $usuarioNuevo = new SignUp;
        $usuarioNuevo->name = $request->name;
        $usuarioNuevo->email = $request->email;
        $usuarioNuevo->password = $request->password;
        $usuarioNuevo->save();
        return back()->with('mensaje', 'Usuario agregado correctamente');
        
    }
    
}
$request -> validate([ 'name' => 'required', 'email' => 'required' , 'password' => 'required' ]);
