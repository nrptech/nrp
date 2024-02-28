@extends('layouts.layout')

@section('title', 'Carrito')

@section('links')
    <!-- Replace the Bootstrap 4 link with Bootstrap 5 links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="{{ asset('js/cart.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('styles/cart.css') }}">
    <!-- Include Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Carrito de Compras</h1>
        
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (empty($products))
            <p class="alert alert-info">El carrito está vacío</p>
        @else
            <ul class="list-group">
                @php
                    $totalPrice = 0;
                @endphp

                @foreach ($products as $product)
                    @php
                        $basePrice = $product->price;
                        $afterTaxes = 0;

                        // Check if the product has a coupon
                        if ($product->coupon) {
                            if ($product->coupon->discount > 0) {
                                $afterTaxes = $product->price * ((100 - $product->coupon->discount) / 100) * (1 + $product->tax->amount / 100);
                            } else {
                                $afterTaxes = $product->price * (1 + $product->tax->amount / 100);
                            }
                        } else {
                            // Handle the case where there is no coupon
                            $basePrice = $product->price;
                            $afterTaxes = $product->price * (1 + $product->tax->amount / 100);
                        }

                        $totalPrice += $afterTaxes * $product->pivot->amount;
                    @endphp

                    <li class="list-group-item d-flex justify-content-between align-items-center singleItem">
                        <div class="d-flex gap-2">
                            <div class="imgMiniature">
                                @if ($product->images->isNotEmpty())
                                    <img class="img-fluid rounded" src="{{ asset($product->images->first()->url) }}"
                                        alt="{{ $product->name }}" class="w-100" id="img{{ $product->id }}-0">
                                @endif
                            </div>

                            <span class="fw-bold">{{ $product->name }} X {{ $product->pivot->amount }}</span>
                        </div>

                        <div class="d-flex gap-2 align-items-center">
                            <button onclick="show(this)" class="btn btn-danger py-0 deletBtn">X Eliminar</button>
                            <div hidden>
                                <div class="d-flex">
                                    <button class="btn btn-warning" onclick="hide(this)">
                                        Cancelar
                                    </button>
                                    <form action="{{ route('cart.substracAmount', $product) }}" method="post" class="me-2">
                                        @csrf
                                        <input class="rounded-5 px-2" type="number" name="amount" value="1"
                                            min="1" max="{{ $product->pivot->amount }}">
                                        <button type="submit" class="btn btn-danger btn-sm rounded-pill">-Confirmar</button>
                                    </form>
                                </div>
                            </div>

                            @if ($product->pivot->amount >= $product->stock)
                                <button onclick="show(this)" class="btn btn-success py-0 addBtn disabled">
                                    <i class="fas fa-plus"></i> Añadir
                                </button>
                            @else
                                <button onclick="show(this)" class="btn btn-success py-0 addBtn">
                                    <i class="fas fa-plus"></i> Añadir
                                </button>
                            @endif

                            <div hidden>
                                <div class="d-flex">
                                    <button class="btn btn-warning" onclick="hide(this)">
                                        Cancelar
                                    </button>
                                    <form action="{{ route('cart.add', $product) }}" method="post" class="me-2">
                                        @csrf
                                        <input class="rounded-5 px-2 W-25" type="number" name="amount" value="1"
                                            min="1" max="{{ $product->stock - $product->pivot->amount }}">
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i> Confirmar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-column align-items-end">
                            <span class="text-muted">
                                Precio base: {{ number_format($basePrice, 2) }}€
                            </span>

                            <span class="text-muted">
                                {{ $product->tax->taxName . ' ' . $product->tax->amount }}%
                            </span>

                            <span class="text-muted">
                                Precio tras impuestos: {{ number_format($afterTaxes, 2) }}€
                            </span>

                            <span class="text-muted">
                                Precio total: {{ number_format($afterTaxes * $product->pivot->amount, 2) }}€
                            </span>
                        </div>
                    </li>
                @endforeach
            </ul>

            <!-- Mostrar precio total del carrito -->
            <div class="mt-3">
                <h4>Precio total del carrito: {{ number_format($totalPrice, 2) }}€</h4>
            </div>

            <!-- Botón de compra -->
            <div class="mt-3">
                <a href="{{ route('order.show') }}" class="btn btn-primary">
                    Proceder a la Orden <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        @endif
    </div>
@endsection
