@extends('layouts.admin')

@section('title', 'Panel de productos')

@section('links')
    <link rel="stylesheet" href="{{ asset('styles/adminProducts.css') }}">
    <script defer src="{{ asset('js/edit.js') }}"></script>
@endsection

@section('content')

    <h2>Lista de Productos</h2>
    <a href="{{ route('productos.create') }}" class="btn btn-success">Agregar Nuevo Producto</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Imágen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Descripción</th>
                <th>Descuento</th>
                <th>Existencia</th>
                <th>Especificaciones</th>
                <th>Características</th>
                <th>Tipo de Impuesto</th>
                <th>Color</th>
                <th>Categorías</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $product)
                <tr id="view{{ $product->id }}">
                    <td>{{ $product->id }}</td>
                    <td class="imgMiniature">
                        @if ($product->images->isNotEmpty())
                            <img class="img-fluid" src="{{ asset($product->images->first()->url) }}" alt="{{ $product->name }}"
                                class="w-100" id="img{{ $product->id }}-0">
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->discount }}</td>
                    <td>{{ $product->stock }}</td>
                    <td class="specs">{{ $product->specs }}</td>
                    <td>{{ $product->features }}</td>
                    <td>{{ $product->tax->taxName }}</td>
                    <td>{{ $product->color }}</td>
                    <td>
                        @foreach ($product->categories as $category)
                            <p>{{ $category->name }}</p>
                        @endforeach
                    </td>
                    <td>
                        <button onclick="edit({{ $product->id }})" class="btn btn-primary">Editar</button>
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
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr hidden id="edit{{ $product->id }}">
                    <td>{{ $product->id }}</td>
                    <form action="{{ route('productos.update', $product->id) }}" class="form" method="POST">
                        @csrf
                        @method('PUT')
                        <td class="imgMiniature">
                            @if ($product->images->isNotEmpty())
                                <img class="img-fluid" src="{{ asset($product->images->first()->url) }}"
                                    alt="{{ $product->name }}" class="w-100" id="img{{ $product->id }}-0">
                            @endif
                        </td>
                        <td><input type="text" name="name" value="{{ $product->name }}"></td>
                        <td><input type="number" name="price" value="{{ $product->price }}"></td>
                        <td><input type="text" name="description" value="{{ $product->description }}"></td>
                        <td><input type="number" name="discount" value="{{ $product->discount }}"></td>
                        <td><input type="number" name="stock" value="{{ $product->stock }}"></td>
                        <td><input type="text" name="specs" value="{{ $product->specs }}"></td>
                        <td><input type="text" name="features" value="{{ $product->features }}"></td>
                        <td>
                            <select name="tax_id" id="tax_id">
                                @foreach ($taxes as $tax)
                                    <option value="{{ $tax->id }}" @if ($tax->id == $product->tax_id) selected @endif>
                                        {{ $tax->taxName }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" name="color" value="{{ $product->color }}"></td>

                        <td>
                            @php
                                $selectedCategories = $product->categories->pluck('id')->toArray();
                            @endphp
                            @foreach ($allCategories as $category)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="categories[]"
                                        value="{{ $category->id }}" id="category{{ $category->id }}"
                                        {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="category{{ $category->id }}">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach

                        </td>
                        <td>
                            <button class="btn btn-primary">Guardar cambios</button>
                    </form>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#confirmDeleteModal{{ $product->id }}">Eliminar</button>
                    <!-- Modal -->
                    <div class="modal fade" id="confirmDeleteModal{{ $product->id }}" tabindex="-1"
                        aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar eliminación
                                    </h5>
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
