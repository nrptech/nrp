<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use PDF;

class CartController extends Controller
{
    public function showCart()
    {
        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart) {
            return view('cart', ['products' => []]);
        }

        $productsInCart = $cart->products;

        return view('cart', ['products' => $productsInCart]);
    }

    public function addToCart(Product $product, Request $request)
    {
        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart) {
            $cart = $user->cart()->create();
        }

        $amount = $request->input('amount', 1);

        if ($cart->products->contains($product)) {
            $existingAmount = $cart->products()->where('product_id', $product->id)->first()->pivot->amount;
            $newAmount = $existingAmount + $amount;


            if ($product->stock < $newAmount) {
                return redirect()->back()->with('error', 'No hay suficiente stock disponible');
            }

            $cart->products()->updateExistingPivot($product, ['amount' => $newAmount]);
        } else {
            $cart->products()->attach($product, ['amount' => $amount]);
        }

        return redirect()->back()->with('status', 'Producto agregado al carrito');
    }

    public function removeFromCart(Product $product)
    {
        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart) {
            return redirect()->back()->with('error', 'El usuario no tiene un carrito');
        }

        $existingAmount = $cart->products()->where('product_id', $product->id)->first()->pivot->amount;

        if ($existingAmount > 1) {
            $newAmount = $existingAmount - 1;
            $cart->products()->updateExistingPivot($product, ['amount' => $newAmount]);
        } else {
            $cart->products()->detach($product->id);
        }

        return redirect()->back()->with('status', 'Cantidad reducida en el carrito');
    }

    public function substracAmount(Product $product, Request $request)
    {
        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart) {
            return redirect()->back()->with('error', 'El usuario no tiene un carrito');
        }

        $amount = $request->input('amount', 1);

        if ($cart->products->contains($product)) {
            $existingAmount = $cart->products()->where('product_id', $product->id)->first()->pivot->amount;
            $newAmount = $existingAmount - $amount;

            if ($newAmount > 0) {
                $cart->products()->updateExistingPivot($product, ['amount' => $newAmount]);
            } else {
                $cart->products()->detach($product->id);
            }
        }

        return redirect()->back()->with('status', 'Cantidad restada en el carrito');
    }

    public function updateCart(Request $request)
    {
        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart) {
            return redirect()->back()->with('error', 'El usuario no tiene un carrito');
        }

        $amount = $request->input("amount");

        if ($request->input("amount") >= 10) {
            $amount = $request->input("freeAmount");
        }

        $productId = $request->input('product_id');

        if ($amount > 0) {
            $cart->products()->updateExistingPivot($productId, ['amount' => $amount]);
        } else {
            $cart->products()->detach($productId);
        }

        return redirect()->back()->with('status', 'Cantidad actualizada en el carrito');
    }

    public function showOrder()
    {
        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart || $cart->products->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'El carrito está vacío');
        }

        $productsInCart = $cart->products;
        $total = $cart->products->sum(function ($product) {
            return $product->pivot->amount * $product->price;
        });

        return view('order', ['products' => $productsInCart, 'total' => $total]);
    }

    public function confirmOrder(Request $request)
    {
        $finalPrice = $request->input("finalPrice");

        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart || $cart->products->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'El carrito está vacío');
        }

        $productsWithInsufficientStock = [];

        // Check if there is enough stock for each product
        foreach ($cart->products as $product) {
            $requestedAmount = $product->pivot->amount;

            if ($product->stock < $requestedAmount) {
                // Store the product with insufficient stock in an array
                $productsWithInsufficientStock[] = $product->name;
            }
        }

        if (!empty($productsWithInsufficientStock)) {
            // Redirect back with an error message for products with insufficient stock
            $error_message = 'No hay suficiente stock disponible para los siguientes productos: ' . implode(', ', $productsWithInsufficientStock);
            return redirect()->route('cart.show')->with('error', $error_message);
        }

        // Subtract the purchased quantity from the product stock
        foreach ($cart->products as $product) {
            if($product->coupon->active && $product->coupon->quantity > 0){
                $product->coupon->quantity-=1;
                if($product->coupon->quantity <= 0){
                    $product->coupon->active=false;
                }
                $product->coupon->save(); 
            }

            $requestedAmount = $product->pivot->amount;
            $product->stock -= $requestedAmount;
            $product->save();
        }

        // Create a new order associated with the user
        $order = $user->orders()->create(['state' => 'pending']);

        $invoice = new Invoice([
            'total' => $finalPrice,
            'date' => now(),
            'address_id' => $request->input("address"),
            'payMethod_id' => $request->input("payment_method"),
        ]);

        $user = Auth::user();
        $invoice->user_id = $user->id;  
        // Associate the Invoice with the Order
        $invoice->order()->associate($order);
        $invoice->save();

        // Detach all products from the cart
        $cart->products()->detach();
        // Delete the cart
        $cart->delete();

        // Attach products from the cart to the order through the intermediate table
        foreach ($cart->products as $product) {
            $order->products()->attach($product->id, ['amount' => $product->pivot->amount]);
        }
        $order->load(['products', 'invoice']);

        // Generar los datos del pedido para la factura
        $orderData = [
            'order_id' => $order->id,
            'total' => $invoice->total,
            'order' => $order,
            'invoice' => $invoice,
        ];

        // Crear factura en PDF (opcional)
        $pdf = PDF::loadView('invoice', compact('orderData'));

        // Elige si mostrar PDF o la vista Blade (descomenta la opción deseada)

        // 1. Mostrar PDF:
        //return $pdf->stream('factura.pdf'); 
        return view('agradecimiento', compact('orderData'));

        // 2. Mostrar la vista Blade (invoice.blade.php):
        //return view('invoice', compact('orderData')); 
    }

    public function ordershipped(Order $order)
    {
        $order->load(['products', 'invoice']); // Pre-carga las relaciones
        return view('ordershipped', compact('order'));
    }

    public function rejectOrder()
    {
        return redirect()->route('cart.show')->with('status', 'Orden rechazada');
    }

    public function mostrarAgradecimiento()
{
    $user = Auth::user();
    $order = $user->orders()->latest()->first(); // Obtener el pedido más reciente del usuario

    if (!$order) {
        return redirect()->route('home')->with('error', 'No se encontró ningún pedido para mostrar agradecimiento.');
    }

    $invoice = $order->invoice; // Acceder a los datos de la factura asociada al pedido

    // Verificar si se encontraron datos de factura
    if (!$invoice) {
        return redirect()->route('home')->with('error', 'No se encontró ninguna factura asociada al pedido.');
    }

    // Pasar los datos del pedido y la factura a la vista de agradecimiento
    return view('agradecimiento', compact('order', 'invoice'));
}
}
