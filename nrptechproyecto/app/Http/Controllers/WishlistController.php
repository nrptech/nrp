<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Wishlist;
// use App\Models\Product;
use App\Models\WishlistHasProducts;

class WishlistController extends Controller
{
    public function index()
    {
        // Obtener el usuario autenticado
        $user = auth()->user()->id;

        // Obtener la Wishlist del usuario
        $wishlistProducts = Wishlist::where('user_id',$user)->get();

        // Obtener todos los productos (o los que necesites mostrar en la vista)
        // $allProducts = Product::all(); // Puedes ajustar esto según tus necesidades

        return view('wishlist.index', compact('wishlistProducts'));
    }

    public function addToWishlist(Request $request, $product_Id)
{
    // Obtener el usuario autenticado
    $user = auth()->user();

    // Buscar la Wishlist del usuario o crear una nueva si no existe
    $wishlist = $user->wishlist ?? Wishlist::create(['user_id' => $user->id]);

    // Añadir el producto a la Wishlist
    $wishlist->products()->attach($product_Id); 

    return redirect()->route('wishlist.index')->with('success', 'Producto añadido a la Wishlist');
}

public function removeFromWishlist(Request $request, $productId)
{
    // Obtener el usuario autenticado
    $user = auth()->user();

    // Obtener la Wishlist del usuario
    $wishlist = $user->wishlist;

    if ($wishlist) {
        // Quitar el producto de la Wishlist
        $wishlist->products()->detach($productId);

        return redirect()->route('wishlist.index')->with('success', 'Producto eliminado de la Wishlist');
    }

    return redirect()->route('wishlist.index')->with('error', 'No se pudo encontrar la Wishlist del usuario');
}
    
}
