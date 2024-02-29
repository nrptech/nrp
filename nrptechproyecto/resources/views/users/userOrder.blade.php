@extends('layouts.layout')

@section('title', 'Orders')

@section('links')
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .order-summary {
            border: 1px solid #e1e1e1;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .order-number {
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .product-list {
            width: 100%;
        }

        .product-list th,
        .product-list td {
            border-bottom: 1px solid #e1e1e1;
            padding: 10px;
            text-align: left;
        }

        .product-list th {
            background-color: #f8f9fa;
        }

        .product-name {
            font-weight: bold;
        }

        .total-price {
            font-size: 1.2em;
            margin-top: 10px;
            font-weight: bold;
            color: #333;
        }

        .imgMiniature {
            width: 40px;
            margin-right: 10px;
        }

        .imgMiniature img {
            border-radius: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h2 class="mt-4 mb-4">Mis Pedidos</h2>

        @foreach ($user->orders as $order)
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
                                    <img src="{{ $product->images->first()->url }}" alt="{{ $product->name }}" class="imgMiniature">
                                    <span class="product-name">{{ $product->name }}</span>
                                </td>
                                <td>${{ $product->price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <p class="order-status">Estado del pedido: {{ $order->state }}</p>

                @if ($order->invoice)
                    <p class="total-price">Precio total del pedido: ${{ $order->invoice->total }}</p>
                @endif
            </div>
        @endforeach
    </div>
@endsection
