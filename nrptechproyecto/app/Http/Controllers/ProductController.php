<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Image;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        // Add your middleware if needed
        //$this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index', 'show']]);
        //$this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        //$this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        //$this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $productos = Product::all();

        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'discount' => 'numeric',
            'tax_id' => 'numeric',
            'color' => 'string',
            'stock' => 'numeric',
            'specs' => 'string',
            'features' => 'string',
        ]);

        $productData = $request->except('_token', 'image');

        $product = Product::create($productData);

        if ($request->hasFile('image')) {
            $file = $request->file("image");
            $path = "images/";
            $filename = time() . "-" . $file->getClientOriginalName();
            $uploadSucces = $request->file("image")->move($path, $filename);
            $product->images()->create(['url' => $path.$filename]);
        }

        return redirect()->route('productos.index')->with('success', 'Product created successfully.');
    }



    public function show(Product $product)
    {
        return view('productos.show', compact('product'));
    }

    public function edit(Product $producto)
    {

        if (!$producto) {
            return redirect()->route('productos.index')->with('error', 'Product not found');
        }

        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'discount' => 'numeric',
            'stock' => 'numeric',
            'specs' => 'string',
            'features' => 'string',
            'tax_id' => 'numeric',
            'color' => 'string',
        ]);

        $data = $request->all();
        $product->update($data);

        return redirect()->route('productos.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Product deleted successfully');
    }
}
