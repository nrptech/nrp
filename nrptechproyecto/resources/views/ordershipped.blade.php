<!DOCTYPE html>
<html>

<head>
    @section('links')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="{{ asset('js/home.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('styles/orderShipped.css') }}">
@endsection
    <title>Confirmación de Pedido</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="invoice-card">
                    <div class="invoice-header">
                        <h1 class="mb-0">¡Gracias por tu compra!</h1>
                    </div>
                    <div class="invoice-body">
                        <p class="lead">Estado del pedido: En proceso</p>

                        <div class="product-details">
                            <h4>Productos:</h4>
                            <ul>
                                @if (isset($order['products']))
                                    @forelse ($order['products'] as $product)
                                        <li>{{ $product->name }} - Precio: ${{ $product->price }} - Cantidad:
                                            {{ $product->pivot->amount }}</li>
                                    @empty
                                        <li>No hay productos</li>
                                    @endforelse
                                @else
                                    <li>No hay productos</li>
                                @endif
                            </ul>
                        </div>


                        @if (isset($order['invoice']))
                            <p class="lead">El coste total de tu factura es: ${{ $order['invoice']['total'] }}</p>
                        @else
                            <p class="lead">El coste total de tu factura es desconocido</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
