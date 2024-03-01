@extends('layouts.layout')

@section('title', 'Orders')

@section('links')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('styles/userOrder.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2 class="mt-4 mb-4">Mis Pedidos</h2>

        @foreach ($user->orders->reverse() as $order)
            <div class="order-summary">
                <h3 class="order-number">Pedido #{{ $order->id }}</h3>

                <table class="product-list">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->products as $product)
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

                
                @if ($order->invoice->total)
                <p class="total-price">Total + IVA: ${{ $order->invoice->total }}</p>
                @endif
                <p class="order-status">Estado actual: {{ $order->state }}</p>
            </div>
        @endforeach
    </div>
@endsection
