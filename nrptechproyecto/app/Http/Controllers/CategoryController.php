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

        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $input = $request->all();

        Category::create($input);

        return redirect()->back()
            ->with('success', 'Category created successfully');
    }

    public function destroy(Category $category)
    {
        $category->products()->detach();
        $category->products()->delete();
        $category->delete();

        return redirect()->back()->with('success', 'Categoria borrada satisfactoriamente');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $input = $request->all();

        $category = Category::find($id);
        $category->update($input);

        return redirect()->back()->with('success', 'Categoría actualizada correctamente');
    }

}
