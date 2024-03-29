@extends('layouts.admin')

@section('title', 'Panel de usuarios')

@section('links')
    <script defer src="{{ asset('js/edit.js') }}"></script>
@endsection

@section('content')
<div class="container">
<div class="row">
    <div class="col-lg-12 mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Gestión de usuarios</h2>
            <a class="btn btn-success" href="{{ route('users.create') }}">Crear un nuevo usuario</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Métodos de pago</th>
                <th>Direcciones</th>
                <th width="280px">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr id="view{{ $user->id }}">
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->surname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="badge bg-success text-white">{{ $user->role->name }}</span>
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
                        <button onclick="edit({{ $user->id }})" class="btn btn-primary">Editar</button>

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#confirmDeleteModal{{ $user->id }}">
                            Eliminar
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

                <tr id="edit{{ $user->id }}" hidden>
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <td>{{ $user->id }}</td>
                        <td><input type="text" name="name" value="{{ $user->name }}"></td>
                        <td><input type="text" name="surname" value="{{ $user->surname }}"></td>
                        <td><input type="email" name="email" value="{{ $user->email }}"></td>
                        <td>
                            <select name="role" id="role" class="form-select">
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}" {{ $user->role->name == $role ? 'selected' : '' }}>
                                        {{ $role }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <button id="userButton{{$user}}" type="submit" hidden></button>
                    </form>
                    <td>
                        @if (count($user->payMethods) > 0)
                            @foreach ($user->payMethods as $payMethod)
                                <form id="deletePayMethodForm" method="POST"
                                    action="{{ route('users.deletePayMethods', $user->id) }}" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf

                                    <input name="payMethod" type="hidden"
                                        value="{{ $payMethod->id }}">{{ $payMethod->name }}</input>

                                    <button class="btn btn-danger">Eliminar</button>

                                </form>
                            @endforeach
                        @else
                            <p>El usuario no tiene métodos de pago</p>
                        @endif

                    </td>
                    <td>
                        @if (count($user->addresses) > 0)
                            @foreach ($user->addresses as $address)
                                <form id="deleteAddressesForm" method="POST"
                                    action="{{ route('users.deleteAddress', $user->id) }}" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf

                                    <input type="hidden" name="address" value="{{ $address->id }}">{{ $address->name }}

                                    <button class="btn btn-danger">Eliminar</button>
                                </form>
                            @endforeach
                        @else
                            <p>El usuario no tiene direcciones guardadas</p>
                        @endif
                    </td>

                    <td>
                        <label class="btn btn-primary" for="userButton{{$user}}">Guardar</label>

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#confirmDeleteModal{{ $user->id }}">
                            Eliminar
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
        </tbody>
    </table>
</div>
</div>
@if ($users->lastPage() > 1)
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @for ($i = 1; $i <= $users->lastPage(); $i++)
                <li class="page-item {{ $users->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item {{ $users->currentPage() == $users->lastPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
@endif

@endsection
