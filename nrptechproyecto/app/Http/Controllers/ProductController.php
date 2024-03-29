<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Image;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Tax;
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
        $productos = Product::orderBy('id', 'ASC')->paginate(5);
        $taxes = Tax::all();
        $allCategories = Category::all();
        $coupons = Coupon::all();

        return view('admin.productos.index', compact('productos', 'taxes', "allCategories", "coupons"));
    }

    public function create()
    {
        return view('admin.productos.create');
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
            $product->images()->create(['url' => $path . $filename]);
        }

        return redirect()->back()->with('success', 'Product created successfully.');
    }

    public function update(Request $request, $product_id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'coupon_id' => 'numeric',
            'stock' => 'numeric',
            'specs' => 'string',
            'features' => 'string',
            'tax_id' => 'numeric',
            'color' => 'string',
            'categories' => 'array',
        ]);

        $product = Product::FindOrFail($product_id);

        $data = $request->except('image', 'coupon');

        if ($request["coupon_id"] == 0) {
            $data["coupon_id"] = null;
        }

        $product->update($data);

        $product->categories()->detach();
        if ($request->has('categories')) {
            foreach ($request->categories as $category_id) {
                $category = Category::find($category_id);
                $product->categories()->attach($category);
            }
        }

        return redirect()->back()->with('success', 'Producto actualizadísimo correctamente');
    }

    public function hide(Product $product)
    {
        $product->update(['visible' => !$product->visible]);

        return redirect()->back()->with('success', 'El producto se ha ocultado correctamente.');
    }


    public function showProducts()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('products/index', ['products' => $products], ['categories' => $categories]);
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function updateCategories(Request $request)
    {
        $productId = $request->input('product_id');

        $producto = Product::find($productId);
        if (!$producto) {
            return redirect()->route('productos.index')->with('error', 'Producto no encontrado');
        }

        $categoryId = $request->input('category');

        if ($producto->categories()->where('categories.id', $categoryId)->exists()) {
            return redirect()->back()->with('error', 'La categoría ya está asignada al producto');
        }

        $producto->categories()->attach($categoryId);

        return redirect()->back()->with('status', 'Categoría asignada al producto correctamente');
    }
}
