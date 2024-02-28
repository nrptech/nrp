@extends('layouts.admin')

@section('title', 'Panel categorias')

@section('links')
    <script defer src="{{ asset('js/edit.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('styles/pagination.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Categories Management</h2>
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
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr id="view{{ $category->id }}">
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <button onclick="edit({{ $category->id }})" class="btn btn-primary">Edit</button>
                                <form method="POST" action="{{ route('categories.destroy', $category->id) }}" style="display:inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#confirmDeleteModal{{ $category->id }}">Delete</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="confirmDeleteModal{{ $category->id }}" tabindex="-1"
                                        aria-labelledby="confirmDeleteModalLabel{{ $category->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmDeleteModalLabel{{ $category->id }}">Confirmar
                                                        eliminación</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Estás seguro que deseas eliminar la categoría
                                                    <strong>{{ $category->name }}</strong>?
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
                            </td>
                        </tr>
                        <tr hidden id="edit{{ $category->id }}">
                            <td>{{ $category->id }}</td>
                            <form method="POST" action="{{ route('categories.update', $category->id) }}">
                                @method('PATCH')
                                @csrf
                                <td><input type="text" name="name" value="{{ $category->name }}" class="form-control"></td>
                                <td>
                                    <button onclick="edit({{ $category->id }})" class="btn btn-primary">Save changes</button>
                                </td>
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($categories->lastPage() > 1)
            <nav>
                <ul class="pagination justify-content-center">
                    {{-- Botón "anterior" --}}
                    <li class="page-item {{ $categories->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $categories->previousPageUrl() }}" aria-label="Anterior">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    {{-- Mostrar los enlaces de las páginas --}}
                    @for ($i = 1; $i <= $categories->lastPage(); $i++)
                        <li class="page-item {{ $categories->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $categories->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    {{-- Botón "siguiente" --}}
                    <li class="page-item {{ $categories->currentPage() == $categories->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $categories->nextPageUrl() }}" aria-label="Siguiente">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        @endif

        <div class="d-flex justify-content-center flex-column align-items-center bg-secondary text-white text-center">
            <div class="w-75 d-flex justify-content-center flex-column align-items-center">
                <h4>Crear una nueva categoría</h4>
                <form action="{{ route('categories.store') }}" method="POST"
                    class="w-100 d-flex justify-content-center flex-column align-items-center">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nombre de la categoría:</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
