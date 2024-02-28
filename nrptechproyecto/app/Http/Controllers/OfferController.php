<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class OfferController extends Controller
{

    
    public function show()
    {    
        $products = Product::inRandomOrder()->limit(10)->get();

        return view('offer', compact('products'));
    }
}
