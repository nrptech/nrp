<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PayMethod;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::orderBy('id', 'ASC')->paginate(5);

        return view('admin.orders.index', compact('orders'));
    }

    // public function destroy(Coupon $coupon)
    // {
    //     $coupon->products()->detach();
    //     $coupon->users()->detach();
    //     $coupon->categories()->detach();
    //     $coupon->delete();

    //     return redirect()->back()->with('success', 'Cupón borrado satisfactoriamente');
    // }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'state' => 'required|string',
        ]);

        $input = $request->all();
        $order = order::find($id);

        $order->update($input);

        return redirect()->back()
            ->with('success', 'Cupón actualizado correctamente');
    }

    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'name' => 'required',
    //         'expiration' => 'required|date',
    //         'quantity' => 'required|integer',
    //         'discount' => 'required|numeric',
    //     ]);

    //     $input = $request->all();

    //     $expiration = Carbon::parse($input['expiration'])->second(0);
    //     $input['expiration'] = $expiration;

    //     $input['active'] = $request->has('active');

    //     Coupon::create($input);

    //     return redirect()->back()->with('success', 'Cupón creado con éxito');
    // }

    public function showPayMethods()
    {
        $user = User::find(auth()->id());
        $paymentMethods = $user->paymentMethods;

        return view('order.show', compact('paymentMethods'));
    }

    public function savePayMethod(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
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
    public function showOrderSummary()
    {
        $user = Auth::user();

        // Assuming you have a Cart model with a many-to-many relationship between User and Product
        $cart = Cart::where('user_id', $user->id)->with('products')->first();

        if (!$cart) {
            return redirect()->route('cart.show')->with('error', 'No hay productos en el carrito');
        }

        $products = $cart->products;

        // Get the user's payment methods and addresses
        $paymentMethods = $user->payMethods;
        $addresses = $user->addresses;

        return view('order.summary', compact('user', 'products', 'paymentMethods', 'addresses'));
    }
}
