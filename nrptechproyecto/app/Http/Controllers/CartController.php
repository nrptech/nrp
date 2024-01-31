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
    
        $productsInCart = $cart->products;
    
        return view('/cart', ['products' => $productsInCart]);
    }

    public function addToCart(Product $product, Request $request)
    {
        $user = Auth::user();
        $cart = $user->cart;
    
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

    public function updateCart(Request $request)
    {
        $user = Auth::user();
        $cart = $user->cart;
    
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