@extends('layouts.layout')

@section('title', 'Carrito')

@section('content')
    <h1 class="mb-4">Carrito de Compras</h1>

    @if (empty($products))
        <p class="alert alert-info">El carrito está vacío</p>
    @else
        <ul class="list-group">
            @php
                $totalPrice = 0; // Inicializa el precio total

            @endphp

            @foreach ($products as $product)
                @php
                    $basePrice = 0;
                    $afterTaxes = 0;
                    if ($product->discount > 0) {
                        $basePrice = $product->price * ((100 - $product->discount) / 100);
                        $afterTaxes = $product->price * ((100 - $product->discount) / 100) * (1 + $product->tax->amount / 100);
                    } else {
                        $basePrice = $product->price;
                        $afterTaxes = $product->price * (1 + $product->tax->amount / 100);
                    }
                    $totalPrice += $afterTaxes * $product->pivot->amount;
                @endphp

                <li class="list-group-item d-flex justify-content-between align-items-center">

                    <span>{{ $product->name }} X {{ $product->pivot->amount }}</span>

                    <div class="d-flex align-items-center">
                        <!-- Restar cantidad -->
                        <form action="{{ route('cart.substracAmount', $product) }}" method="post" class="me-2">
                            @csrf
                            <input type="hidden" name="amount" value="1">
                            <button type="submit" class="btn btn-danger btn-sm rounded-pill">-</button>
                        </form>

                        <!-- Mostrar cantidad -->
                        <span class="badge bg-primary rounded-circle me-2"></span>

                        <!-- Sumar cantidad -->
                        <form action="{{ route('cart.add', $product) }}" method="post" class="me-2">
                            @csrf
                            <input type="hidden" name="amount" value="1">
                            <button type="submit" class="btn btn-success btn-sm rounded-pill">+</button>
                        </form>
                    </div>

                    <span class="">
                        Precio base: {{ number_format($basePrice, 2) }}€
                    </span>

                    <span class="">
                        {{ $product->tax->taxName . ' ' . $product->tax->amount }}%
                    </span>

                    <span class="">
                        Precio tras impuestos:
                        {{ number_format($afterTaxes, 2) }}€
                    </span>


                    <span class="">
                        Precio total:
                        {{ number_format($afterTaxes * $product->pivot->amount, 2) }}€
                    </span>

                </li>
            @endforeach
        </ul>

        <!-- Mostrar precio total del carrito -->
        <div class="mt-3">
            <h4>Precio total del carrito: {{ number_format($totalPrice, 2) }}€</h4>
        </div>

        <!-- Botón de compra -->
        <div class="mt-3">
            <a href="{{ route('order.show') }}" class="btn btn-primary">Proceder a la Orden</a>
        </div>

    @endif


@endsection
