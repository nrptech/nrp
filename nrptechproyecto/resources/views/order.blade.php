<!-- resources/views/order.blade.php -->
@extends('layouts.app') <!-- Asegúrate de tener un layout base para tus vistas -->

@section('content')
    <h1>Resumen de la Orden</h1>

    <!-- Mostrar resumen de la orden (puedes personalizar según tus necesidades) -->
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio unitario</th>
                <th>Precio total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->pivot->amount }}</td>
                    <td>${{ $product->price }}</td>
                    <td>${{ $product->pivot->amount * $product->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Mostrar el total -->
    <div class="total">
        <p>Total: ${{ $total }}</p>
    </div>

    <!-- Botones de confirmación y rechazo -->
    <form method="post" action="{{ route('confirmOrder') }}">
        @csrf
        <button type="submit">Confirmar Orden</button>
    </form>

    <form method="post" action="{{ route('rejectOrder') }}">
        @csrf
        <button type="submit">Rechazar Orden</button>
    </form>
@endsection
