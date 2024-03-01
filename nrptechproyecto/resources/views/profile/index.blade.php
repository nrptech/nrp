@extends('layouts.layout')

@section('title', 'Ajustes')

@section('links')
    <script defer src="{{ asset('js/profile.js') }}"></script>
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card mb-4">
            <div class="card-header">
                <h1 class="display-4">Datos de usuario</h1>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Nombre:</strong> {{ $user->name }}</li>
                    <li class="list-group-item"><strong>Apellidos:</strong> {{ $user->surname }}</li>
                    <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                </ul>
                <button onclick="edit()" class="btn btn-primary mt-3">Editar tus datos</button>
            </div>
        </div>

        <div class="card mb-4" hidden>
            <div class="card-header">
                <h1 class="display-4">Editar datos de usuario</h1>
            </div>
            <div class="card-body">
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
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password"
                                class="form-control">
                        </div>
                    </div>
            
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Confirmar cambios</button>
                        <button class="btn btn-danger" type="button" onclick="view()">X</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h1 class="display-4">Datos de pago</h1>
        </div>
        <div class="card-body">
            <div class="d-flex flex-column">
                <!-- Display payment methods as cards -->
                @foreach ($user->payMethods as $payMethod)
                    @if (!$payMethod->deleted)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Método de pago: {{ $payMethod->name }}</h5>
                                <ul class="list-group">
                                    <li class="list-group-item">Titular de la tarjeta: {{ $payMethod->card_holder }}</li>
                                    <li class="list-group-item">Número de la tarjeta: {{ $payMethod->card_number }}</li>
                                </ul>
                                <!-- Delete form and modal go here -->
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <button onclick="addPayMethod(this)" class="btn btn-primary mt-3">Añadir un nuevo método de pago</button>
            <div hidden>
                <form method="post" action="{{ route('savePay') }}">
                    @csrf
                    <!-- Payment method form fields go here -->
                    <button type="submit" class="btn btn-primary mt-3">Guardar Método de Pago</button>
                </form>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h1 class="display-4">Direcciones</h1>
        </div>
        <div class="card-body">
            <!-- Display addresses as cards -->
            @foreach ($user->addresses as $address)
                @if (!$address->deleted)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Nombre de la dirección: {{ $address->name }}</h5>
                            <ul class="list-group">
                                <li class="list-group-item">País: {{ $address->country }}</li>
                                <li class="list-group-item">Provincia: {{ $address->province }}</li>
                                <li class="list-group-item">Ciudad: {{ $address->city }}</li>
                                <li class="list-group-item">Calle: {{ $address->street }}, {{ $address->number }}</li>
                                <li class="list-group-item">Código postal: {{ $address->pc }}</li>
                            </ul>
                            <!-- Delete form and modal go here -->
                        </div>
                    </div>
                @endif
            @endforeach
            <button onclick="addAddress(this)" class="btn btn-primary mt-3">Añadir una nueva dirección</button>
            <div hidden>
                <form method="post" action="{{ route('saveAddress') }}">
                    @csrf
                    <!-- Address form fields go here -->
                    <button type="submit" class="btn btn-primary mt-3">Guardar Dirección</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection