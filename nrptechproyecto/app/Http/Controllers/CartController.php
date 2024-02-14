<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $productId = $request->input('product_id');
        $amount = $request->input('amount');

        $currentamount = $cart->products()->where('product_id', $productId)->first()->pivot->amount;

        $newamount = $currentamount - $amount;

        if ($newamount > 0) {
            $cart->products()->updateExistingPivot($productId, ['amount' => $newamount]);
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

    public function confirmOrder()
    {
        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart || $cart->products->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'El carrito está vacío');
        }

        // Crear un nuevo pedido asociado al usuario
        $order = $user->orders()->create();

        // Lógica para crear un nuevo invoice
        $invoice = new Invoice([
            'total' => $cart->products->sum(function ($product) {
                return $product->pivot->amount * $product->price;
            }),
            'date' => now(), // Puedes ajustar la fecha según tus necesidades
        ]);

        // Asociar el Invoice con el Order
        $invoice->order()->associate($order);
        $invoice->save();

        // Eliminar el carrito y desvincular todos los productos
        $cart->products()->detach();
        $cart->delete();

        // Enviar el correo electrónico con el seguimiento
        $orderData = [
            'order_id' => $order->id,
            'total' => $invoice->total,
            // Agrega cualquier otra información que desees enviar en el correo
        ];

        Mail::to($user->email)->send(new OrderShipped($orderData));

        // Redirigir a la vista de agradecimiento
        return view('agradecimiento');
    }



    public function rejectOrder()
    {
        return redirect()->route('cart.show')->with('status', 'Orden rechazada');
    }

    public function mostrarAgradecimiento()
    {
        $user = Auth::user();
        $cart = $user->cart;

        if ($cart) {
            // Eliminar el carrito y desvincular todos los productos
            $cart->products()->detach();
            $cart->delete();
        }

        return view('agradecimiento');
    }
}
