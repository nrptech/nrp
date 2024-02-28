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

                        if (optional($product->coupon)->discount > 0 && optional($product->coupon)->active) {
                            $afterTaxes = $product->price * ((100 - optional($product->coupon)->discount) / 100) * (1 + $product->tax->amount / 100);
                        } else {
                            $afterTaxes = $product->price * (1 + $product->tax->amount / 100);
                        }

                        $totalPrice += $afterTaxes * $product->pivot->amount;
                    @endphp
                    <p hidden class="afterTaxes">{{ $afterTaxes }} </p>
                    <div>
                        <li class="list-group-item d-flex justify-content-between align-items-center singleItem">
                            <div class="d-flex gap-2">
                                <div class="imgMiniature">
                                    @if ($product->images->isNotEmpty())
                                        <img class="img-fluid rounded" src="{{ asset($product->images->first()->url) }}"
                                            alt="{{ $product->name }}" class="w-100" id="img{{ $product->id }}-0">
                                    @endif
                                </div>
                                <div>
                                    <form action="{{ route('cart.update') }}" method="POST">
                                        @csrf
                                        <span class="fw-bold">{{ $product->name }}</span>
                                        <div class="d-flex">
                                            
                                            <select @if ($product->pivot->amount>10) style="display: none;" @endif class="form-control cantidad" name="amount">
                                                @for ($i = 1; $i <= min($product->stock, 9); $i++)
                                                    <option value="{{ $i }}"
                                                        {{ $product->pivot->amount == $i ? 'selected' : '' }}>
                                                        {{ $i }}
                                                    </option>
                                                @endfor
                                                <option value="10"
                                                    {{ $product->pivot->amount >= 10 ? 'selected' : '' }}
                                                    {{ $product->stock >= 10 ? '' : 'disabled' }}>10+</option>
                                                <option class="text-bg-danger" value="0">Eliminar</option>
                                            </select>
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <input type="number" class="form-control mt-2 cantidad-manual"  @if ($product->pivot->amount>10) value="{{($product->pivot->amount)}}" @else value="10"  @endif 
                                                name="freeAmount" @if ($product->pivot->amount>10) style="display: block; "@else style="display: none;" @endif
                                                placeholder="Ingrese la cantidad" max="{{ $product->stock }}"
                                                min="0">
                                            <button class="btn btn-success">✓</button>
                                        </div>

                                    </form>
                                </div>

                            </div>

                            <div class="d-flex flex-column align-items-end">
                                <span class="text-muted">
                                    Precio base: {{ number_format($basePrice, 2) }}€
                                </span>
                                @if (optional($product->coupon)->active)
                                    <span class="text-muted">
                                        {{ $product->coupon->name . ' -' . $product->coupon->discount }}%
                                    </span>
                                @endif


                                <span class="text-muted">
                                    {{ $product->tax->taxName . ' ' . $product->tax->amount }}%
                                </span>

                                <span class="text-muted">
                                    Precio tras impuestos: {{ number_format($afterTaxes, 2) }}€
                                </span>

                                <span class="text-muted">
                                    Precio total: <span
                                        class="totalPrice">{{ number_format($afterTaxes * $product->pivot->amount, 2) }}</span>€
                                </span>
                            </div>
                        </li>
                    </div>
                @endforeach
            </ul>

            <!-- Mostrar precio total del carrito -->
            <div class="mt-3">
                <h4>Precio total del carrito: <span class="totalCartPrice">{{ number_format($totalPrice, 2) }}</span>€</h4>
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
