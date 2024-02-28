@extends('layouts.layout')

@section('title', 'Pedido')

@section('links')
    <!-- Replace the Bootstrap 4 link with Bootstrap 5 links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="{{ asset('js/cart.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('styles/cart.css') }}">
@endsection

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Resumen del pedido</h1>

        <ul class="list-group">
            @php
                $totalPrice = 0;
            @endphp

            @foreach ($products as $product)
                @php
                    $basePrice = $product->price;
                    $afterTaxes = 0;
                    if ($product->coupon->discount > 0) {
                        $afterTaxes = $product->price * ((100 - $product->coupon->discount) / 100) * (1 + $product->tax->amount / 100);
                    } else {
                        $afterTaxes = $product->price * (1 + $product->tax->amount / 100);
                    }
                    $totalPrice += $afterTaxes * $product->pivot->amount;
                @endphp

                <li class="list-group-item d-flex justify-content-between align-items-center singleItem">
                    <div class="d-flex gap-2 align-items-center">
                        <div class="imgMiniature">
                            @if ($product->images->isNotEmpty())
                                <img class="img-fluid rounded" src="{{ asset($product->images->first()->url) }}"
                                    alt="{{ $product->name }}" id="img{{ $product->id }}-0">
                            @endif
                        </div>

                        <span class="fw-bold">{{ $product->name }} X {{ $product->pivot->amount }}</span>
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

        <div class="mt-3">
            <h4 class="text-primary">Precio total del pedido: {{ number_format($totalPrice, 2) }}€</h4>
        </div>

        @if (Auth::user()->payMethods->isEmpty())
            <p class="text-danger">No tienes métodos de pago guardados.</p>
            <form method="post" action="{{ route('savePay') }}">
                @csrf
                <!-- Add Bootstrap form-control class for styling -->
                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombre de la tarjeta:</label>
                        <input type="text" id="name" name="name" class="form-control" required max="100">
                    </div>

                    <div class="col-md-6">
                        <label for="card_holder" class="form-label">Titular de la tarjeta:</label>
                        <input type="text" id="card_holder" name="card_holder" class="form-control" required
                            max="100">
                    </div>

                    <div class="col-md-6">
                        <label for="card_number" class="form-label">Numero de la tarjeta:</label>
                        <input type="number" id="card_number" name="card_number" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="cvv" class="form-label">CVV:</label>
                        <input type="number" id="cvv" name="cvv" class="form-control" required>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Guardar Método de Pago</button>
                    </div>
                </div>
            </form>
        @else
            <form method="post" action="{{ route('confirmOrder') }}">
                @csrf
                <div class="mt-3">
                    <label for="payment_method" class="form-label">Seleccionar método de pago:</label>
                    <select name="payment_method" id="payment_method" class="form-select">
                        @foreach (Auth::user()->payMethods as $paymentMethod)
                            <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>

            <div class="mt-3">
                <button onclick="addPayMethod(this)" class="btn btn-primary">Añadir un nuevo método de pago</button>
                <div hidden>
                    <form method="post" action="{{ route('savePay') }}">
                        @csrf
                        <div class="row g-3 mt-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nombre de la tarjeta:</label>
                                <input type="text" id="name" name="name" class="form-control" required
                                    max="100">
                            </div>

                            <div class="col-md-6">
                                <label for="card_holder" class="form-label">Titular de la tarjeta:</label>
                                <input type="text" id="card_holder" name="card_holder" class="form-control" required
                                    max="100">
                            </div>

                            <div class="col-md-6">
                                <label for="card_number" class="form-label">Numero de la tarjeta:</label>
                                <input type="number" id="card_number" name="card_number" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label for="cvv" class="form-label">CVV:</label>
                                <input type="number" id="cvv" name="cvv" class="form-control" required>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-success">Guardar Método de Pago</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        @if (Auth::user()->addresses->isEmpty())
            <button type="submit" class="btn btn-primary mt-3" disabled>Confirmar Pedido</button>
            <p class="text-danger">No tienes direcciones guardadas.</p>
            <form method="post" action="{{ route('saveAddress') }}">
                @csrf

                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombre de la dirección:</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="province" class="form-label">Provincia:</label>
                        <input type="text" id="province" name="province" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="city" class="form-label">Ciudad:</label>
                        <input type="text" id="city" name="city" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="street" class="form-label">Calle:</label>
                        <input type="text" id="street" name="street" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="number" class="form-label">Número:</label>
                        <input type="text" id="number" name="number" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="pc" class="form-label">Código postal:</label>
                        <input type="text" id="pc" name="pc" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="country" class="form-label">País:</label>
                        <input type="text" id="country" name="country" class="form-control" required>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Guardar Dirección</button>
                    </div>
                </div>
            </form>
        @else
            <div class="mt-3">
                <button onclick="addPayMethod(this)" class="btn btn-primary">Añadir una nueva dirección</button>
                <div hidden>
                    <form method="post" action="{{ route('saveAddress') }}">
                        @csrf
                        <div class="row g-3 mt-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nombre de la dirección:</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label for="province" class="form-label">Provincia:</label>
                                <input type="text" id="province" name="province" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label for="city" class="form-label">Ciudad:</label>
                                <input type="text" id="city" name="city" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label for="street" class="form-label">Calle:</label>
                                <input type="text" id="street" name="street" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label for="number" class="form-label">Número:</label>
                                <input type="text" id="number" name="number" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label for="pc" class="form-label">Código postal:</label>
                                <input type="text" id="pc" name="pc" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label for="country" class="form-label">País:</label>
                                <input type="text" id="country" name="country" class="form-control" required>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-success">Guardar Dirección</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <form method="post" action="{{ route('confirmOrder') }}">
                @csrf
                <div class="mt-3">
                    <label for="address" class="form-label">Seleccionar dirección:</label>
                    <select name="address" id="address" class="form-select">
                        @foreach (Auth::user()->addresses as $address)
                            <option value="{{ $address->id }}">{{ $address->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success mt-3">Confirmar Pedido</button>
            </form>
        @endif

        <form method="post" action="{{ route('rejectOrder') }}">
            @csrf
            <button type="submit" class="btn btn-danger mt-3">Rechazar Pedido</button>
        </form>
    </div>
@endsection
