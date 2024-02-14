@extends('layouts.admin')

@section('title', 'Eliminar direcciones')

@section('links')
    <link rel="stylesheet" href="../../css/app.css">
    <script defer src="../../js/app.js"></script>
    <script defer src="../../js/bootstrap.js"></script>
@endsection

@section('content')
    <h1>Eliminar direcciones</h1>
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
    </div>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form id="deleteAddressForm" method="POST" action="{{ route('users.deleteAddress', $user->id) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
    
        <div class="mb-3">
            <p>{{ $user->name }}</p>
    
            @if (count($assignedAddresses) > 0)
                <div>
                    <label for="address" class="form-label">Direcciones</label>
                    <select class="form-select" id="address" name="address">
                        @foreach ($assignedAddresses as $address)
                            <option value="{{ $address->id }}">{{ $address->name }}</option>
                        @endforeach
                    </select>
                </div>
    
    
                <input type="hidden" name="user_id" value="{{ $address->id }}">
                <div class="text-center">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#confirmDeleteModal">Eliminar</button>
                </div>
            @else
                <h4>El usuario no tiene ninguna dirección asignada.</h4>
            @endif
        </div>
    </form>
    
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar la dirección del usuario <strong>{{ $user->name }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" form="deleteAddressForm" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    
@endsection
