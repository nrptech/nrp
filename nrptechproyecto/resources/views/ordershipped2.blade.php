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
@section('content')
<div class="container">
    <h2 class="mt-4 mb-4">Detalles del Último Pedido</h2>

    @if ($user->orders->isNotEmpty())
        @php
            $latestOrder = $user->orders->sortByDesc('id')->first();
        @endphp

        <div class="order-summary">
            <h3 class="order-number">Pedido #{{ $latestOrder->id }}</h3>

            <table class="product-list">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($latestOrder->products as $product)
                        <tr>
                            <td>
                                <img src="{{ $product->images->first()->url }}" alt="{{ $product->name }}"
                                    class="imgMiniature">
                                <span class="product-name">{{ $product->name }}</span>
                            </td>
                            <td>${{ $product->price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if ($latestOrder->invoice->total)
                <p class="total-price">Total + IVA: ${{ $latestOrder->invoice->total }}</p>
            @endif
            <p class="order-status">Estado actual: {{ $latestOrder->state }}</p>
        </div>
    @else
        <p>No se encontraron pedidos.</p>
    @endif
</div>
@endsection