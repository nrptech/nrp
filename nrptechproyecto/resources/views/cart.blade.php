<!DOCTYPE html>
<html lang="en">

<head>
    <title>Carrito</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.3.2 -->
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

    <main class="container mt-4">
        <h1 class="mb-4">Carrito de Compras</h1>

        @if ($products->isEmpty())
            <p class="alert alert-info">El carrito está vacío</p>
        @else
            <ul class="list-group">
                @foreach ($products as $product)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $product->name }}
                        <span class="badge bg-primary rounded-pill">Cantidad: {{ $product->pivot->amount }}</span>

                        <!-- Formulario para eliminar cantidad -->
                        <form action="{{ route('cart.update') }}" method="POST" class="ms-2">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="number" name="amount" min="1" max="{{ $product->pivot->amount }}" value="1"
                                class="form-control d-inline-block" style="width: 70px;">
                            <button type="submit" class="btn btn-danger btn-sm ms-2">Eliminar</button>
                        </form>
                    </li>
                    <!-- Agrega aquí más detalles del producto si es necesario -->
                @endforeach
            </ul>
        @endif

    </main>

    <footer class="mt-4">
        <!-- Agrega contenido del pie de página si es necesario -->
    </footer>
</body>

</html>
