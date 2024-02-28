@extends('layouts.layout')

@section('title', 'Ajustes')

@section('links')
    <script defer src="{{ asset('js/profile.js') }}"></script>
@endsection

@section('content')
    <div>
        <div id="view">
            <h1>Datos de usuario</h1>
            <ul>
                <li><strong>Nombre:</strong> {{ $user->name }}</li>
                <li><strong>Apellidos:</strong> {{ $user->surname }}</li>
                <li><strong>Email:</strong> {{ $user->email }}</li>
            </ul>
            <button onclick="edit()" class="btn btn-primary">Editar tus datos</button>
        </div>
        <div id="edit" hidden>
            <h1>Editar datos de usuario</h1>
            <form method="POST" action="{{ route('profile.update', $user->id) }}">
                @method('PATCH')
                @csrf

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="name" placeholder="Name" class="form-control"
                                value="{{ old('name', $user->name) }}">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Surname:</strong>
                            <input type="text" name="surname" placeholder="surname" class="form-control"
                                value="{{ old('surname', $user->surname) }}">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Email:</strong>
                            <input type="text" name="email" placeholder="Email" class="form-control"
                                value="{{ old('email', $user->email) }}">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Password:</strong>
                            <input type="password" name="password" placeholder="Password" class="form-control">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Confirm Password:</strong>
                            <input type="password" name="password_confirmation" placeholder="Confirm Password"
                                class="form-control">
                        </div>
                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Confirmar cambios</button>
                        <button class="btn btn-danger" type="button" onclick="view()">X</button>
                    </div>
                </div>
            </form>
        </div>

        <div>
            <h1>Datos de pago</h1>
            <div class="d-flex flex-column">

                @foreach ($user->payMethods as $payMethod)
                    <div class="d-flex">
                        <ul>
                            <li>
                                Método de pago: {{ $payMethod->name }}
                            </li>
                            <ul>
                                <li>Titular de la tarjeta: {{ $payMethod->card_holder }}</li>
                                <li>Número de la tarjeta: {{ $payMethod->card_number }}</li>
                            </ul>
                        </ul>
                        <form id="deletePayMethodForm" method="POST" action="{{ route('profile.deletePayMethod') }}"
                            enctype="multipart/form-data">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="payMethod" value="{{ $payMethod->id }}">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deletePayMethodModal">🗑️</button>

                            <div class="modal fade" id="deletePayMethodModal" tabindex="-1"
                                aria-labelledby="deletePayMethodModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deletePayMethodModalLabel">Confirmar eliminación
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Estás seguro de que deseas eliminar {{ $payMethod->name }}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach

            </div>
        </div>


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
        <h1>Direcciones</h1>
        @foreach ($user->addresses as $address)
            <div class="d-flex">
                <ul>
                    <li>
                        Nombre de la dirección: {{ $address->name }}
                    </li>
                    <ul>
                        <li>País: {{ $address->country }}</li>
                        <li>Province: {{ $address->province }}</li>
                        <li>Ciudad: {{ $address->city }}</li>
                        <li>Calle: {{ $address->street }}, {{ $address->number }}</li>
                        <li>Código postal: {{ $address->pc }}</li>
                    </ul>
                </ul>
                <form id="deleteAddress" method="POST" action="{{ route('profile.deleteAddress') }}"
                    enctype="multipart/form-data">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="address" value="{{ $address->id }}">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#deleteAddressModal">🗑️</button>

                    <!-- Modal -->
                    <div class="modal fade" id="deleteAddressModal" tabindex="-1"
                        aria-labelledby="deleteAddressModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteAddressModalLabel">Confirmar eliminación
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Estás seguro de que deseas eliminar {{ $address->name }}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endforeach
        <div>
            <button onclick="addPayMethod(this)">Añadir un nuevo método de pago</button>
            <div hidden>
                <form method="post" action="{{ route('saveAddress') }}">
                    @csrf
                    <label for="name">Nombre de la dirección:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="province">Provincia:</label>
                    <input type="text" id="province" name="province" required>

                    <label for="city">Ciudad:</label>
                    <input type="text" id="city" name="city" required>

                    <label for="street">Calle:</label>
                    <input type="text" id="street" name="street" required>

                    <label for="number">Número:</label>
                    <input type="text" id="number" name="number" required>

                    <label for="pc">Código postal:</label>
                    <input type="text" id="pc" name="pc" required>

                    <label for="country">País:</label>
                    <input type="text" id="country" name="country" required>

                    <button type="submit">Guardar Dirección</button>
                </form>
            </div>
        </div>
    </div>
    <div>
        <h4>PEDIDOS</h4>
        @foreach ($user->orders as $order)
        <h5> Referencia del pedido: {{ $order->id }}</h5>
            @foreach ($order->products as $product)
                <img class="w-25" src="{{ $product->images->first()->url }}" alt="{{ $product->name }}">
                <p>{{ $product->name }}</p>
            @endforeach
            <p>
                @if ($order->invoice)
                    Precio total del pedido: {{ $order->invoice->total }}
                @endif
            </p>
        @endforeach
    </div>
@endsection
