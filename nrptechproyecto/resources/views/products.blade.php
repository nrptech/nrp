<?php
use App\Models\Product;

?>

<!DOCTYPE html>
<html>

<head>
    <title>Mi Vista de Ejemplo</title>
</head>

<body>
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
