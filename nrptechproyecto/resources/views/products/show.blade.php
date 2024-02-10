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

    <script defer src="{{ asset('js/productShow.js') }}"></script>

</head>

<body>
    @include('header')

    <main>
        <article class="imagesAndPrice d-flex justify-content-between">
            <section class="images w-50 mx-5 mt-5">
                <div class="mainImg bg-danger">
                    @if ($product->images->isNotEmpty())
                        <img src="{{ asset($product->images->first()->url) }}" alt="{{ $product->name }}"
                            class="img-fluid mb-2 w-100">
                    @endif
                </div>
                <div class="imgSelector d-flex bg-black">
                    <button class="leftArrow">
                    </button>
                    <div class="d-flex justify-content-around">
                        @foreach ($product->images as $key => $image)
                            <img src="{{ asset($image->url) }}" alt="{{ $image->url }}" id="img{{ $key + 1 }}"
                                class="img-fluid mb-2 w-25">
                        @endforeach
                    </div>
                    <button class="rightArrow">
                    </button>
                </div>
            </section>
            <div class="nameAndPrice mx-5 mt-5 text-center bg-secondary d-flex flex-column justify-content-around w-25">
                <h3>{{ $product->name }}</h3>

                <h3>Disponibilidad:</h3>
                @if ($product->stock > 0)
                    <p class="text-success fw-bold"> {{ $product->stock }} En stock </p>
                @else
                    <p class="text-danger">Fuera de stock</p>
                @endif

                @if ($product->discount > 0)
                <h4 class="badge text-warning">¡Estamos de oferta!</h4>
                <p>Rebaja del {{$product->discount}}%</p>
                <p class="card-text">Precio original:<span class="text-decoration-line-through text-danger">
                    {{ number_format($product->price * (1 + $product->tax->amount / 100), 2) }}€</span></p>
                    <p class="card-text"><strong>Precio rebajado:</strong><span class="text-success">
                        {{ number_format(($product->price * ((100-$product->discount)/100) ) * (1 + $product->tax->amount / 100), 2) }}€</span>
            @else
                <p class="card-text"><strong>Precio:</strong>
                    {{ number_format($product->price * (1 + $product->tax->amount / 100), 2) }}€</p>
            @endif
                <form action="{{ route('cart.add', $product) }}" method="post">
                    @csrf
                    <input hidden type="number" name="amount" value="1" min="1" class="form-control mb-2">
                    <button type="submit" class="btn btn-primary">Añadir al carrito</button>
                </form>
            </div>
        </article>
        <section class="specifications mx-5 mt-5">
            <div class="about">
                <h2>Descripción del producto</h2>
                <p>{{ $product->description }}</p>
            </div>
            <div class="specs">
                <h2>Especificaciones</h2>
                <p>{{ $product->specs }}</p>
            </div>
        </section>
    </main>

    <footer>

    </footer>
</body>

</html>
