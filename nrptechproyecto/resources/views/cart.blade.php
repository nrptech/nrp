@extends('layouts.layout')

@section('title', 'Carrito')

@section('links')
    <script defer src="{{ asset('js/cart.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('styles/cart.css') }}">
@endsection
@section('content')
    <h1 class="mb-4">Carrito de Compras</h1>

    @if (empty($products))
        <p class="alert alert-info">El carrito está vacío</p>
    @else
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
                                <img class="img-fluid" src="{{ asset($product->images->first()->url) }}"
                                    alt="{{ $product->name }}" class="w-100" id="img{{ $product->id }}-0">
                            @endif
                        </div>

                        <span>{{ $product->name }} X {{ $product->pivot->amount }}</span>
                    </div>


                    <div class="d-flex gap-2 align-items-center">

                        <button onclick="show(this)" class="btn btn-danger py-0 deletBtn">Eliminar</button>
                        <div hidden>
                            <div class="d-flex">
                                <button onclick="hide(this)">
                                    X
                                </button>
                                <form action="{{ route('cart.substracAmount', $product) }}" method="post" class="me-2">
                                    @csrf
                                    <input class="rounded-5 px-2" type="number" name="amount" value="1"
                                        min="1" max="{{ $product->pivot->amount }}">
                                    <button type="submit" class="btn btn-danger btn-sm rounded-pill">-</button>
                                </form>
                            </div>
                        </div>


                        @if ($product->pivot->amount >= $product->stock)
                            <button onclick="show(this)" class="btn btn-success py-0 addBtn disabled">Añadir</button>
                        @else
                            <button onclick="show(this)" class="btn btn-success py-0 addBtn">Añadir</button>
                        @endif

                        <div hidden>
                            <div class="d-flex">
                                <button onclick="hide(this)">
                                    X
                                </button>
                                <form action="{{ route('cart.add', $product) }}" method="post" class="me-2">
                                    @csrf
                                    <input class="rounded-5 px-2 W-25" type="number" name="amount" value="1"
                                        min="1" max="{{ $product->stock - $product->pivot->amount }}">
                                    <button type="submit" class="btn btn-success btn-sm">+</button>
                                </form>
                            </div>
                        </div>



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
