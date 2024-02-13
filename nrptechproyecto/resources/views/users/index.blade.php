@extends('layouts.admin')

@section('title', 'Panel de usuarios')

@section('links')
    <link rel="stylesheet" href="../../css/app.css">
    <script defer src="../../js/app.js"></script>
    <script defer src="../../js/bootstrap.js"></script>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Users Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th>Metodos de pago</th>
            <th>Direcciones</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <label class="badge badge-success text-success">{{ $user->role->name }}</label>
                </td>
                <td>
                    @foreach ($user->payMethods as $payMethod)
                        <div>
                            <p>{{ $payMethod->name }}</p>
                        </div>
                    @endforeach
                </td>
                <td>
                    @foreach ($user->addresses as $address)
                        <div>
                            <p>{{ $address->name }}</p>
                        </div>
                    @endforeach
                </td>
                <td>
                    <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                    <a href="{{ route('users.removePayMethod', $user->id) }}" class="btn btn-primary">Delete
                        pay methods</a>
                    <a href="{{ route('users.removeAddresses', $user->id) }}" class="btn btn-primary">Delete Addresses</a>

                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#confirmDeleteModal{{ $user->id }}">
                        Delete
                    </button>

                    <div class="modal fade" id="confirmDeleteModal{{ $user->id }}" tabindex="-1"
                        aria-labelledby="confirmDeleteModalLabel{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel{{ $user->id }}">Confirmar
                                        eliminación</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Estás seguro que deseas eliminar al usuario <strong>{{ $user->name }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}"
                                        style="display:inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $data->render() !!}
@endsection
