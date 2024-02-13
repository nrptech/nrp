@extends('layouts.layout')

@section('title', 'Ajustes')

@section('links')
    <script defer src="{{ asset('js/cart.js') }}"></script>
@endsection

@section('content')
    <div>
        <h1>Datos de usuario</h1>
        <ul>
            <li>{{ $user->name }}</li>
            <li>{{ $user->surname }}</li>
            <li>{{ $user->email }}</li>
        </ul>
        <form method="GET" action="{{ route('profile.edit', $user->name) }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <button type="submit" class="btn btn-primary">Editar datos de usuario</button>
        </form>
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
@endsection
