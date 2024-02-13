<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PayMethod;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->paginate(5);
        return view('users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return response()->view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'roles' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        // Use the correct role names and set the guard_name
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return response()->view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'sometimes|confirmed',
            'roles' => 'required',
        ]);

        $input = $request->all();

        if (!empty($input['password'])) {
            $input['password'] = bcrypt($input['password']);
        } else {
            unset($input['password']);
        }

        $user = User::find($id);
        $user->update($input);

        $user->syncRoles($request->input('roles'));

        return redirect()->back()->with('success', 'User updated successfully');
    }

    public function profileUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|confirmed|min:6',
        ]);
    
        // Obtener el usuario a actualizar
        $user = User::findOrFail($id);
    
        // Actualizar los datos del usuario
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        
        // Actualizar la contraseña si se proporcionó una nueva
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
    
        // Guardar los cambios en la base de datos
        $user->save();
    
        // Redirigir de vuelta a la página de perfil con un mensaje de éxito
        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function showProfile(Request $request)
    {
        $userId = $request->input('user_id');

        $user = User::find($userId);

        if ($user) {
            return view('profile.index', ['user' => $user]);
        } else {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }
    }

    public function editProfile(Request $request){
        $userId = $request->input('user_id');

        $user = User::find($userId);

        if ($user) {
            return view('profile.edit', ['user' => $user]);
        } else {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.index')
                ->with('error', 'User not found');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }

    public function savePayMethod(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'card_holder' => 'required|string',
            'card_number' => 'required|regex:/^\d{16}$/',
            'cvv' => 'required|digits:3',
        ]);

        $payMethodData = [
            'user_id' => auth()->id(),
            'name' => $request->input('name'),
            'card_holder' => $request->input('card_holder'),
            'card_number' => $request->input('card_number'),
            'cvv' => $request->input('cvv'),
        ];

        PayMethod::create($payMethodData);

        return redirect()->back()->with('success', 'Método de pago guardado exitosamente.');
    }

    public function removePayMethod(User $user)
    {
        if (!$user) {
            return redirect()->route('user.index')->with('error', 'Usuario no encontrado');
        }

        $assignedPayMethods = $user->payMethods;

        return view('users.removePayMethod', compact('user', 'assignedPayMethods'));
    }

    public function deletePayMethod(Request $request)
    {
        $payMethodId = $request->input('payMethod');
        $payMethodId = PayMethod::find($payMethodId);

        if (!$payMethodId) {
            return redirect()->back()->with('error', 'Método de pago no encontrado');
        }

        $payMethodId->delete();

        return redirect()->back()->with('status', 'Método de pago eliminado correctamente');
    }

    public function saveAddress(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'street' => 'required|string',
            'number' => 'required|string',
            'pc' => 'required|digits:5',
            'country' => 'required|string',
        ]);

        $address = [
            'user_id' => auth()->id(),
            'name' => $request->input('name'),
            'province' => $request->input('province'),
            'city' => $request->input('city'),
            'street' => $request->input('street'),
            'number' => $request->input('number'),
            'pc' => $request->input('pc'),
            'country' => $request->input('country'),
        ];

        Address::create($address);

        return redirect()->back()->with('success', 'Dirección guardada exitosamente.');
    }

    public function removeAddresses(User $user)
    {
        if (!$user) {
            return redirect()->route('user.index')->with('error', 'Usuario no encontrado');
        }

        $assignedAddresses = $user->addresses;

        return view('users.removeAddresses', compact('user', 'assignedAddresses'));
    }

    public function deleteAddress(Request $request)
    {
        $addressId = $request->input('address');
        $addressId = Address::find($addressId);


        if (!$addressId) {
            return redirect()->back()->with('error', 'Dirección no encontrada');
        }

        $addressId->delete();

        return redirect()->back()->with('status', 'Dirección eliminada correctamente');
    }


}
