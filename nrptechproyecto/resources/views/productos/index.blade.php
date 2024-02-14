@extends('layouts.admin')

@section('title', 'Panel de productos')

@section('links')
    <link rel="stylesheet" href="../../css/app.css">
    <script defer src="../../js/app.js"></script>
    <script defer src="../../js/bootstrap.js"></script>
@endsection

@section('content')

    <h2>Lista de Productos</h2>
    <a href="{{ route('productos.create') }}" class="btn btn-success">Agregar Nuevo Producto</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Descripción</th>
                <th>Descuento</th>
                <th>Existencia</th>
                <th>Especificaciones</th>
                <th>Características</th>
                <th>ID de Impuesto</th>
                <th>Color</th>
                <th>Categorías</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->discount }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->specs }}</td>
                    <td>{{ $product->features }}</td>
                    <td>{{ $product->tax_id }}</td>
                    <td>{{ $product->color }}</td>
                    <td>
                        @foreach ($product->categories as $category)
                            <p>{{ $category->name }}</p>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('productos.edit', $product->id) }}" class="btn btn-primary">Editar</a>
                        <a href="{{ route('productos.addCategory', $product->id) }}" class="btn btn-primary">Editar
                            Categorías</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#confirmDeleteModal{{ $product->id }}">Eliminar</button>
                        <!-- Modal -->
                        <div class="modal fade" id="confirmDeleteModal{{ $product->id }}" tabindex="-1"
                            aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar eliminación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Estás seguro de que deseas eliminar el producto
                                        <strong>{{ $product->name }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        <form method="POST" action="{{ route('productos.destroy', $product->id) }}"
                                            style="display:inline">
                                            @method('DELETE')
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
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


@endsection
