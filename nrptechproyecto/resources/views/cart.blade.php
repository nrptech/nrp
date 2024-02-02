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

<!-- ... (código anterior) ... -->

<body>
    @include('header')

    <main class="container mt-4">
        <h1 class="mb-4">Carrito de Compras</h1>

        @if (empty($products))
            <p class="alert alert-info">El carrito está vacío</p>
        @else
            <ul class="list-group">
                @php
                    $totalPrice = 0; // Inicializa el precio total
                @endphp

                @foreach ($products as $product)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <!-- Restar cantidad -->
                            <form action="{{ route('cart.substracAmount', $product) }}" method="post" class="me-2">
                                @csrf
                                <input type="hidden" name="amount" value="1">
                                <button type="submit" class="btn btn-danger btn-sm rounded-pill">-</button>
                            </form>

                            <!-- Mostrar cantidad -->
                            <span class="badge bg-primary rounded-circle me-2">{{ $product->pivot->amount }}</span>

                            <!-- Sumar cantidad -->
                            <form action="{{ route('cart.add', $product) }}" method="post" class="me-2">
                                @csrf
                                <input type="hidden" name="amount" value="1">
                                <button type="submit" class="btn btn-success btn-sm rounded-pill">+</button>
                            </form>
                        </div>

                        <!-- Mostrar nombre del producto -->
                        <span>{{ $product->name }}</span>

                        <!-- Mostrar precio por unidad -->
                        <span class="badge bg-success rounded-pill me-2">
                            Precio por unidad: ${{ number_format($product->price, 2) }}
                        </span>

                        <!-- Mostrar precio por cantidad -->
                        <span class="badge bg-dark rounded-pill me-2">
                            Precio por cantidad: ${{ number_format($product->price * $product->pivot->amount, 2) }}
                        </span>

                    </li>

                    @php
                        $totalPrice += $product->price * $product->pivot->amount; // Suma al precio total
                    @endphp
                @endforeach
            </ul>

            <!-- Mostrar precio total del carrito -->
            <div class="mt-3">
                <h4>Precio total del carrito: ${{ number_format($totalPrice, 2) }}</h4>
            </div>

            <!-- Botón de compra -->
            <div class="mt-3">
                <a href="" class="btn btn-primary">Comprar</a>
            </div>
        @endif

    </main>

    <footer class="mt-4">
        <!-- Agrega contenido del pie de página si es necesario -->
    </footer>
</body>
</html>
