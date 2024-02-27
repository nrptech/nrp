@extends('layouts.admin')

@section('title', 'Panel de productos')

@section('links')
    <link rel="stylesheet" href="{{ asset('styles/adminProducts.css') }}">
    <script defer src="{{ asset('js/edit.js') }}"></script>
@endsection

@section('content')

    <h2>Lista de Productos</h2>
    <a href="{{ route('productos.create') }}" class="btn btn-success">Agregar Nuevo Producto</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Imágen</th>
                <th>Visibilidad</th>
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
                            <img class="img-fluid" src="{{ asset($product->images->first()->url) }}"
                                alt="{{ $product->name }}" class="w-100" id="img{{ $product->id }}-0">
                        @endif
                    </td>
                    <td>{{ $product->visible ? 'Visible' : 'oculto' }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                        {{ optional($product->coupon)->name }}
                        @if (optional($product->coupon)->discount)
                            {{ optional($product->coupon)->discount }}%
                        @endif
                    </td>
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
                            data-bs-target="#confirmDeleteModal{{ $product->id }}">{{ $product->visible ? "Ocultar" : "Mostrar"}}</button>

                        <!-- Modal -->
                        <div class="modal fade" id="confirmDeleteModal{{ $product->id }}" tabindex="-1"
                            aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar {{ $product->visible ? "ocultadita" : "mostradita"}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Estás seguro de que deseas {{ $product->visible ? "ocultar" : "mostrar"}} el producto
                                        <strong>{{ $product->name }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        <form method="POST" action="{{ route('productos.hide', $product->id) }}"
                                            style="display:inline">
                                            @method('PUT')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">{{ $product->visible ? "Ocultar" : "Mostrar"}}</button>
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
                        <td><input type="text" name="name" value="{{ $product->name }}" class="form-control"></td>
                        <td><input type="number" name="price" value="{{ $product->price }}" class="form-control"></td>
                        <td><input type="text" name="description" value="{{ $product->description }}"
                                class="form-control"></td>
                        <td>
                            <select name="coupon_id" id="coupon_id" class="form-select">
                                <option value="0">Sin descuento</option>
                                @foreach ($coupons as $coupon)
                                    <option value="{{ $coupon->id }}" @if ($coupon->id == $product->coupon_id) selected @endif>
                                        {{ $coupon->name . ' ' . $coupon->discount . '%' }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" name="stock" value="{{ $product->stock }}" class="form-control"></td>
                        <td><input type="text" name="specs" value="{{ $product->specs }}" class="form-control"></td>
                        <td><input type="text" name="features" value="{{ $product->features }}" class="form-control">
                        </td>
                        <td>
                            <select name="tax_id" id="tax_id" class="form-select">
                                @foreach ($taxes as $tax)
                                    <option value="{{ $tax->id }}" @if ($tax->id == $product->tax_id) selected @endif>
                                        {{ $tax->taxName . ' ' . $tax->amount . '%' }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" name="color" value="{{ $product->color }}" class="form-control"></td>

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
                        </td>
                    </form>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if ($productos->lastPage() > 1)
        <nav>
            <ul class="pagination justify-content-center">
                {{-- Botón "anterior" --}}
                <li class="page-item {{ $productos->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $productos->previousPageUrl() }}" aria-label="Anterior">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                {{-- Mostrar los enlaces de las páginas --}}
                @for ($i = 1; $i <= $productos->lastPage(); $i++)
                    <li class="page-item {{ $productos->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $productos->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                {{-- Botón "siguiente" --}}
                <li class="page-item {{ $productos->currentPage() == $productos->lastPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $productos->nextPageUrl() }}" aria-label="Siguiente">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    @endif



@endsection
