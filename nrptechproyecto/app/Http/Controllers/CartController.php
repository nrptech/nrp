<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function showCart()
    {
        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart) {
            return view('cart', ['products' => []]); // No hay carrito, retornar vista con una lista vacía
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
}
