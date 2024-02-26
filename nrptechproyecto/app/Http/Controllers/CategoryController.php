<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $categories = Category::orderBy('id', 'ASC')->paginate(5);

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $input = $request->all();

        $category = Category::create($input);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully');
    }

    public function destroy(Category $category)
    {
        $category->products()->detach();
        $category->products()->delete();
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Categoria borrada satisfactoriamente');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $input = $request->all();

        $category = Category::find($id);
        $category->update($input);

        return redirect()->route('categories.index')
            ->with('success', 'Categoría actualizada correctamente');
    }

}
