@extends('layouts.layout')

@section('title', 'Ajustes')

@section('links')
    <script defer src="{{ asset('js/profile.js') }}"></script>
@endsection

@section('content')
    <div class="container mt-4">
        <div id="view">
            <h1 class="display-4">Datos de usuario</h1>
            <ul class="list-group">
                <li class="list-group-item"><strong>Nombre:</strong> {{ $user->name }}</li>
                <li class="list-group-item"><strong>Apellidos:</strong> {{ $user->surname }}</li>
                <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
            </ul>
            <button onclick="edit()" class="btn btn-primary mt-3">Editar tus datos</button>
        </div>
        <div id="edit" hidden>
            <h1 class="display-4">Editar datos de usuario</h1>
            <form method="POST" action="{{ route('profile.update', $user->id) }}">
                @method('PATCH')
                @csrf
            
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-label"><strong>Name:</strong></label>
                            <input type="text" name="name" id="name" placeholder="Name" class="form-control"
                                value="{{ old('name', $user->name) }}">
                        </div>
                    </div>
            
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="surname" class="form-label"><strong>Surname:</strong></label>
                            <input type="text" name="surname" id="surname" placeholder="Surname" class="form-control"
                                value="{{ old('surname', $user->surname) }}">
                        </div>
                    </div>
            
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="form-label"><strong>Email:</strong></label>
                            <input type="text" name="email" id="email" placeholder="Email" class="form-control"
                                value="{{ old('email', $user->email) }}">
                        </div>
                    </div>
            
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" class="form-label"><strong>Password:</strong></label>
                            <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                        </div>
                    </div>
            
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label"><strong>Confirm Password:</strong></label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" class="form-control">
                        </div>
                    </div>
            
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Confirmar cambios</button>
                        <button class="btn btn-danger" type="button" onclick="view()">X</button>
                    </div>
                </div>
            </form>
        </div>

        <div>
            <h1 class="display-4">Datos de pago</h1>
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
            <button onclick="addPayMethod(this)" class="btn btn-primary mt-3">Añadir un nuevo método de pago</button>
            <div hidden>
                <form method="post" action="{{ route('savePay') }}">
                    @csrf
                    <label for="name" class="form-label">Nombre de la tarjeta:</label>
                    <input type="text" id="name" name="name" required max="100" class="form-control">

                    <label for="card_holder" class="form-label">Titular de la tarjeta:</label>
                    <input type="text" id="card_holder" name="card_holder" required max="100" class="form-control">

                    <label for="card_number" class="form-label">Numero de la tarjeta:</label>
                    <input type="number" id="card_number" name="card_number" required class="form-control">

                    <label for="cvv" class="form-label">CVV:</label>
                    <input type="number" id="cvv" name="cvv" required class="form-control">

                    <button type="submit" class="btn btn-primary mt-3">Guardar Método de Pago</button>
                </form>
            </div>
        </div>
        <h1 class="display-4">Direcciones</h1>
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

                    <div class="modal fade" id="deleteAddressModal" tabindex="-1" aria-labelledby="deleteAddressModalLabel"
                        aria-hidden="true">
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
        <button onclick="addAddress(this)" class="btn btn-primary mt-3">Añadir una nueva dirección</button>
        <div hidden>
            <form method="post" action="{{ route('saveAddress') }}">
                @csrf
                <label for="name" class="form-label">Nombre de la dirección:</label>
                <input type="text" id="name" name="name" required class="form-control">

                <label for="province" class="form-label">Provincia:</label>
                <input type="text" id="province" name="province" required class="form-control">

                <label for="city" class="form-label">Ciudad:</label>
                <input type="text" id="city" name="city" required class="form-control">

                <label for="street" class="form-label">Calle:</label>
                <input type="text" id="street" name="street" required class="form-control">

                <label for="number" class="form-label">Número:</label>
                <input type="text" id="number" name="number" required class="form-control">

                <label for="pc" class="form-label">Código postal:</label>
                <input type="text" id="pc" name="pc" required class="form-control">

                <label for="country" class="form-label">País:</label>
                <input type="text" id="country" name="country" required class="form-control">

                <button type="submit" class="btn btn-primary mt-3">Guardar Dirección</button>
            </form>
        </div>
    </div>
@endsection
