<?php
use App\Models\Product;
?>

<!DOCTYPE html>
<html lang="es">

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

    <script defer src="{{ asset('js/productIndex.js') }}"></script>

</head>

<body>
    @include('header')

    <div class="container mt-4">
        <div class="row">
            @foreach ($products as $product)
            <div class="col-md-6 mb-4 productContainer product{{$product->id}}">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <div class="productImages d-flex w-100 justify-content-center align-content-center">
                            @if (count($product->images) > 1)
                                <button class="leftArrow" onclick="changeImg({{ $product->id }}, -1)">
                                </button>
                            @endif
        
                            @foreach ($product->images as $key => $image)
                                <img hidden src="{{ asset("$image->url") }}" alt="{{ $product->name }}"
                                    class="img-fluid mb-2" id="img{{ $product->id }}-{{ $key }}">
                            @endforeach
        
                            @if (count($product->images) > 1)
                                <button class="rightArrow" onclick="changeImg({{ $product->id }}, 1)">
                                </button>
                            @endif
                        </div>
                        <p class="card-text"><strong>Precio:</strong>
                            {{ number_format($product->price * (1 + $product->tax->amount / 100), 2) }}€</p>
                        <p class="card-text"><strong>Descripción:</strong> {{ $product->description }}</p>
                        <a href="{{ route('products.show', $product) }}" class="btn btn-primary">Ver producto</a>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>

</body>

</html>
