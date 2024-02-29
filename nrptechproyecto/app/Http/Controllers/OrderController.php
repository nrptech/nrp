<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PayMethod;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Coupon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::orderBy('id', 'ASC')->paginate(5);

        return view('admin.orders.index', compact('orders'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'state' => 'required|string',
        ]);

        $input = $request->all();
        $order = order::find($id);

        $order->update($input);

        return redirect()->back()
            ->with('success', 'Pedido actualizado correctamente');
    }

    public function applyDiscount(Request $request)
    {

        $code = $request->input('couponName');
        $coupon = Coupon::where('name', $code)->first();

        if ($coupon->active && $coupon->quantity > 0) {
            if ($coupon->products->count() > 0) {
                return redirect()->back()->with('failure', 'El cupón no se puede aplicar porque está vinculado a productos');
            }

            if ($coupon->categories->count() > 0) {
                return redirect()->back()->with('failure', 'El cupón no se puede aplicar porque está vinculado a categorías');
            }

            $coupon->quantity-=1;
            if($coupon->quantity <= 0 ){
                $coupon->active=false;
            }
            $coupon->save();
            $discount = $coupon->discount;
            return redirect()->back()->with('discount', $discount);
        }

        return redirect()->back()->with('failure', 'Cupón no encontrado');
    }

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

    public function printInvoice($orderId){
        $order = Order::findOrFail($orderId);

        $pdf = Pdf::loadView('users.invoice');

        $fecha = now()->format('Y-m-d_H-i-s');

        return $pdf->download('Factura_BayGaming_'.$fecha.'.pdf');
    }
}
