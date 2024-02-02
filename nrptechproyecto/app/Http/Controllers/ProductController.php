<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function __construct()
    {
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
            'stock' => 'numeric',
            'specs' => 'string',
            'features' => 'string',
            'tax_id' => 'numeric',
            'color' => 'string',

        ]);

        $data = $request->except('_token');

        Product::create($data);

        return redirect()->route('productos.index')
            ->with('success', 'Product created successfully.');
    }
    public function show(Product $product)
    {
        return view('productos.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('productos.edit', compact('product'));
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
