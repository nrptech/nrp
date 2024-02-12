@extends('layouts.layout')

@section('title', 'Pedido')

@section('links')
    <script defer src="{{ asset('js/cart.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('styles/cart.css') }}">
@endsection

@section('content')
    <h1>Resumen del pedido</h1>

    <ul class="list-group">
        @php
            $totalPrice = 0;
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

            <li class="list-group-item d-flex justify-content-between align-items-center singleItem">

                <div class="d-flex gap-2">
                    <div class="imgMiniature">
                        @if ($product->images->isNotEmpty())
                            <img class="img-fluid" src="{{ asset($product->images->first()->url) }}" alt="{{ $product->name }}"
                                class="w-100" id="img{{ $product->id }}-0">
                        @endif
                    </div>

                    <span>{{ $product->name }} X {{ $product->pivot->amount }}</span>
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
        <h4>Precio total del pedido: {{ number_format($totalPrice, 2) }}€</h4>
    </div>

    <!-- Botones de confirmación y rechazo -->
    @if (Auth::user()->payMethods->isEmpty())
        <button type="submit" disabled>Confirmar Pedido</button>
        <p>No tienes métodos de pago guardados.</p>
        <form method="post" action="{{ route('savePay') }}">
            @csrf
            <label for="name">Nombre de la tarjeta:</label>
            <input type="text" id="name" name="name" required max="100">

            <label for="card_holder">Titular de la tarjeta:</label>
            <input type="text" id="card_holder" name="card_holder" required max="100">

            <label for="card_number">Numero de la tarjeta:</label>
            <input type="number" id="card_number" name="card_number" required>

            <label for="cvv">CVV:</label>
            <input type="number" id="cvv" name="cvv" required>

            <button type="submit">Guardar Método de Pago</button>
        </form>
    @else
        <div>
            <button onclick="addPayMethod(this)">Añadir un nuevo método de pago</button>
            <div hidden>
                <form method="post" action="{{ route('savePay') }}">
                    @csrf
                    <label for="name">Nombre de la tarjeta:</label>
                    <input type="text" id="name" name="name" required max="100">
        
                    <label for="card_holder">Titular de la tarjeta:</label>
                    <input type="text" id="card_holder" name="card_holder" required max="100">
        
                    <label for="card_number">Numero de la tarjeta:</label>
                    <input type="number" id="card_number" name="card_number" required>
        
                    <label for="cvv">CVV:</label>
                    <input type="number" id="cvv" name="cvv" required>
        
                    <button type="submit">Guardar Método de Pago</button>
                </form>
            </div>
        </div>


        <form method="post" action="{{ route('confirmOrder') }}">
            @csrf
            <select name="payment_method">
                @foreach (Auth::user()->payMethods as $paymentMethod)
                    <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}</option>
                @endforeach
            </select>
            <button type="submit">Confirmar Pedido</button>
        </form>
    @endif

    <form method="post" action="{{ route('rejectOrder') }}">
        @csrf
        <button type="submit">Rechazar Pedido</button>
    </form>
@endsection
