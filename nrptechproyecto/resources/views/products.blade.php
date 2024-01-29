<?php
use App\Models\Product;

?>

<!DOCTYPE html>
<html>

<head>
    <title>Productos</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</head>


<body>

    @include("header")

    @foreach ($products as $product)
        <div class="product">
            <h2>{{ $product->name }}</h2>
            <p><strong>Precio:</strong> {{ $product->price }}</p>
            <p><strong>Descripción:</strong> {{ $product->description }}</p>
            <p><strong>Descuento:</strong> {{ $product->discount }}</p>
            <p><strong>Tax:</strong> {{ $product->tax->amount }}</p>
            <p><strong>Color:</strong> {{ $product->color }}</p>
            <p><strong>Stock:</strong> {{ $product->stock }}</p>
            <p><strong>Specs:</strong> {{ $product->specs }}</p>
            <p><strong>Features:</strong> {{ $product->features }}</p>
        </div>
    @endforeach
</body>

</html>
