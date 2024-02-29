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
            padding: 20px;
        }

        .order-number {
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .product-list {
            width: 100%;
            margin-top: 20px;
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

        .product-list td:nth-child(2) {
            text-align: right;
        }

        .product-list th:nth-child(2) {
            text-align: right;
        }

        .product-name {
            font-weight: bold;
        }

        .total-price {
            font-size: 1.2em;
            margin-top: 10px;
            font-weight: bold;
            color: #333;
            text-align: right;
        }

        .imgMiniature {
            width: 40px;
            margin-right: 10px;
            border-radius: 20px;
        }

        .order-status {
            margin-top: 10px;
            font-size: 1em;
            color: #555;
            text-align: right;
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
