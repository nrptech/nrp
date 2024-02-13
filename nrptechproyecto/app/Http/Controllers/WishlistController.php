<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\User;

class WishlistController extends Controller
{
    public function index()
{
    // Obtener la lista actual
    $wishlist = auth()->user()->wishlist;

    // Verificar si el usuario tiene una, si no, crea una nueva
    if (!$wishlist) {
        $wishlist = auth()->user()->wishlist()->create();
    }

    // Obtener todos los productos asociados a la lista
    $wishlistItems = $wishlist->products;

    return view('wishlist.index', compact('wishlistItems'));
}

    public function addToWishlist(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // Obtener la lista de deseos actual del usuario
        $wishlist = auth()->user()->wishlist;

        // Verificar si el usuario tiene una lista de deseos
        if (!$wishlist) {
            // Si no tiene una lista de deseos, crea una nueva
            $wishlist = auth()->user()->wishlist()->create();
        }

        // Verificar si el producto ya está en la lista de deseos
        if ($wishlist->products->contains($request->input('product_id'))) {
            return redirect()->route('wishlist.index')->with('error', 'El producto ya está en la lista de deseos');
        }

        // Agregar el producto a la lista de deseos
        $wishlist->products()->attach($request->input('product_id'));

        return redirect()->route('wishlist.index')->with('success', 'Producto añadido a la lista de deseos');
    }

    public function removeFromWishlist($product_id)
    {
        // Obtener la lista de deseos actual del usuario
        $wishlist = auth()->user()->wishlist;

        // Eliminar el producto de la lista de deseos
        $wishlist->products()->detach($product_id);

        return redirect()->route('wishlist.index')->with('success', 'Producto eliminado de la lista de deseos');
    }
}
