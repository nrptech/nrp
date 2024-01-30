<!DOCTYPE html>
<html lang="en">

<head>
    <title>Carrito</title>
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
    @include('header')

    <main>
        <h1>Carrito de Compras</h1>

        @if ($products->isEmpty())
        <p>El carrito está vacío</p>
    @else
        <ul>
            @foreach ($products as $product)
                <li>
                    {{ $product->name }} - Cantidad: {{ $product->pivot->amount }}
                    
                    <!-- Formulario para eliminar cantidad -->
                    <form action="{{ route('cart.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="amount" min="1" max="{{ $product->pivot->amount }}" value="1">
                        <button type="submit">Eliminar</button>
                    </form>
                </li>
                <!-- Agrega aquí más detalles del producto si es necesario -->
            @endforeach
        </ul>
    @endif

    </main>

    <footer>

    </footer>
</body>

</html>
