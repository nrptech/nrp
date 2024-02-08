<?php
use App\Models\Product;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Productos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/Products.css') }}">

    <!-- Bootstrap JS y Popper.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</head>

<body>

    @include('header')

    <div class="container mt-4">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <div class="product-images">
                                @foreach ($product->images as $image)
                                    <img src="{{ asset("$image->url") }}" alt="{{ $product->name }}" class="img-fluid mb-2">
                                @endforeach
                            </div>
                            <p class="card-text"><strong>Precio:</strong> {{ $product->price }}</p>
                            <p class="card-text"><strong>Descripción:</strong> {{ $product->description }}</p>
                            <p class="card-text"><strong>Descuento:</strong> {{ $product->discount }}</p>
                            <p class="card-text"><strong>Tax:</strong> {{ $product->tax->amount }}</p>
                            <p class="card-text"><strong>Color:</strong> {{ $product->color }}</p>
                            <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>
                            <p class="card-text"><strong>Specs:</strong> {{ $product->specs }}</p>
                            <p class="card-text"><strong>Features:</strong> {{ $product->features }}</p>
                            <form action="{{ route('cart.add', $product) }}" method="post">
                                @csrf
                                <input hidden type="number" name="amount" value="1" min="1"
                                    class="form-control mb-2">
                                <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>

</html>
