<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura NRP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Agrega el enlace a Bootstrap CDN para utilizar sus estilos -->
</head>
<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-6">
                <img class="logo" src="" alt="NRP">
                <div class="company-info">
                    <h2>NRP</h2>
                    <p>Torre Sevilla</p>
                    <p>Sevilla, 41009</p>
                    <p>+34 955 555 555</p>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <h1 class="title">Factura</h1>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <p><strong>Número de pedido:</strong> {{ $orderData['order_id'] }}</p>
                <p><strong>Fecha:</strong> {{ $orderData['invoice']->date }}</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderData['order']->products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->pivot->amount }}</td>
                            <td>{{ number_format($product->price, 2) }}€</td>
                            <td>{{ number_format($product->pivot->amount * $product->price, 2) }}€</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-right">Total</th>
                            <td>{{ number_format($orderData['invoice']->total, 2) }}€</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="footer">
                    <p>Gracias por su compra.</p>
                    <p>Para cualquier consulta, no dude en contactarnos.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
