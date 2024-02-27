<?php

namespace App\Http\Controllers\Auth; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\User;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home'; // Change this to /verify after registration

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        // Your user creation logic here...

        return User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']), // Usamos bcrypt para cifrar la contraseña
        ]);
    }

    protected function registered(Request $request, $user)
    {
        // Check if the 'redirect_to_verification' input is present
        if ($request->input('redirect_to_verification') === 'true') {
            // Redirect the user to the verification notice page
            return redirect()->route('verification.notice');
        }

        // If not, use the default behavior
        return redirect($this->redirectPath());
    }
}
