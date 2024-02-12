<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="../../css/app.css">
    <script defer src="../../js/app.js"></script>
    <script defer src="../../js/bootstrap.js"></script>
</head>

<body>

    <h2>Product List</h2>

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
                        <a href="{{ route('productos.addCategory', $product->id) }}" class="btn btn-primary">Edit categories</a>
                        <form method="POST" action="{{ route('productos.destroy', $product->id) }}"
                            style="display:inline">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <a href="{{ route('productos.create') }}" class="btn btn-success">Add New Product</a>
    <a class="btn btn-primary" href="{{ route('users.index') }}"> Go to users</a>
    <a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a>
</body>

</html>
