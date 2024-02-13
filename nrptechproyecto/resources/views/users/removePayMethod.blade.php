@extends('layouts.admin')

@section('title', 'Admin dashboard')

@section('links')
    <link rel="stylesheet" href="../../css/app.css">
    <script defer src="../../js/app.js"></script>
    <script defer src="../../js/bootstrap.js"></script>
@endsection

@section('content')
    <h1>Eliminar método de pago</h1>
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

    <form method="POST" action="{{ route('users.deletePayMethods', $user->id) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="mb-3">
            <p>{{ $user->name }}</p>

            @if (count($assignedPayMethods) > 0)
                <div>
                    <label for="payMethod" class="form-label">Métodos de pago</label>
                    <select class="form-select" id="payMethod" name="payMethod">
                        @foreach ($assignedPayMethods as $payMethod)
                            <option value="{{ $payMethod->id }}">{{ $payMethod->name }}</option>
                        @endforeach
                    </select>
                </div>


                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <div class="text-center">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#confirmDeleteModal">Eliminar</button>
                </div>
                @else 
                <h4>El usuario no tiene ningún metodo de pago asignado.</h4>
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
                    ¿Estás seguro de que deseas eliminar el método de pago del usuario <strong>{{ $user->name }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" form="deletePayMethodForm" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
