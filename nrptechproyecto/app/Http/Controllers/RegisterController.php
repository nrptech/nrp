<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\User;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home'; // Change this to /verify after registration

    public function store(Request $request)
    {
        $this->validate($request, [
        'name' => ['required', 'alpha', 'max:255'],
        'surname' => ['required', 'alpha', 'max:255'],
        'email' => ['required', 'email', 'regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/i', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:12', 'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'],
    ], [
        'name.required' => 'Por favor, ingrese su nombre.',
        'name.alpha' => 'El nombre solo puede contener caracteres alfabéticos.',
        'name.max' => 'El nombre no puede tener más de :max caracteres.',
        
        'surname.required' => 'Por favor, ingrese sus apellidos.',
        'surname.alpha' => 'Los apellidos solo pueden contener caracteres alfabéticos.',
        'surname.max' => 'Los apellidos no pueden tener más de :max caracteres.',
        
        'email.required' => 'Por favor, ingrese su correo electrónico.',
        'email.email' => 'Ingrese una dirección de correo electrónico válida.',
        'email.regex' => 'La dirección de correo electrónico debe tener el formato cuenta@servidor.extension.',
        'email.max' => 'El correo electrónico no puede tener más de :max caracteres.',
        'email.unique' => 'Esta dirección de correo electrónico ya está en uso.',
        
        'password.required' => 'Por favor, ingrese una contraseña.',
        'password.string' => 'La contraseña debe ser una cadena de caracteres.',
        'password.min' => 'La contraseña debe tener al menos :min caracteres.',
        'password.regex' => 'La contraseña debe contener al menos una mayúscula, un número y un carácter especial.',
    ]);

    $user = $this->create($request->all());

    return redirect('/')
        ->with('success', '¡Usuario registrado exitosamente! Te hemos enviado un mensaje.');

}

    protected function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']), // Usamos bcrypt para cifrar la contraseña
        ]);
    }

    protected function registered(Request $request, $user)
{
    return redirect('/')
        ->with('success', '¡Te has registrado exitosamente! Se ha enviado un correo electrónico de verificación.');
}

}
