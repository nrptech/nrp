@extends('layouts.admin')

@section('title', 'Panel de productos')

@section('links')
    <link rel="stylesheet" href="../../css/app.css">
    <script defer src="../../js/app.js"></script>
    <script defer src="../../js/bootstrap.js"></script>
@endsection

@section('content')

    <h2>Product List</h2>
    <a href="{{ route('productos.create') }}" class="btn btn-success">Add New Product</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Discount</th>
                <th>Stock</th>
                <th>Specs</th>
                <th>Features</th>
                <th>Tax ID</th>
                <th>Color</th>
                <th>Categorias</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->discount }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->specs }}</td>
                    <td>{{ $product->features }}</td>
                    <td>{{ $product->tax_id }}</td>
                    <td>{{ $product->color }}</td>
                    <td>
                        @foreach ($product->categories as $category)
                            <p>{{ $category->name }}</p>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('productos.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('productos.addCategory', $product->id) }}" class="btn btn-primary">Edit
                            categories</a>
                        <form method="POST" action="{{ route('productos.destroy', $product->id) }}" style="display:inline">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


@endsection