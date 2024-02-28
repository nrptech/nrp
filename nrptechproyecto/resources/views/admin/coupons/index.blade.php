@extends('layouts.admin')

@section('title', 'Cupones')

@section('links')
    <script defer src="{{ asset('js/edit.js') }}"></script>
    <script defer src="{{ asset('js/apply.js') }}"></script>
@endsection

@section('content')
    <h2>Cupones</h2>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Fecha de caducidad</th>
                <th>Cantidad de cupones</th>
                <th>% de descuento</th>
                <th>Estado</th>
                <th>Productos</th>
                <th>Categorias</th>
                <th>Gestionar</th>
            </tr>
            @foreach ($coupons as $coupon)
                <tr id="view{{ $coupon->id }}" class="view">
                    <td>{{ $coupon->id }}</td>
                    <td>{{ $coupon->name }}</td>
                    <td>{{ $coupon->expiration }}</td>
                    <td>{{ $coupon->quantity }}</td>
                    <td>{{ $coupon->discount }}</td>
                    <td>{{ $coupon->active ? 'Activo' : 'Inactivo' }}</td>
                    <td>
                        @foreach ($coupon->products as $product)
                            {{ $product->name }}
                        @endforeach
                    </td>
                    <td>
                        @foreach ($coupon->categories as $category)
                            {{ $category->name }},
                        @endforeach
                    </td>
                    <td>
                        <button onclick="edit({{ $coupon->id }})" class="btn btn-primary">Edit</button>
                        <form method="POST" action="{{ route('coupons.destroy', $coupon->id) }}" style="display:inline">
                            @method('DELETE')
                            @csrf
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#confirmDeleteModal{{ $coupon->id }}">Delete</button>

                            <!-- Modal -->
                            <div class="modal fade" id="confirmDeleteModal{{ $coupon->id }}" tabindex="-1"
                                aria-labelledby="confirmDeleteModalLabel{{ $coupon->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmDeleteModalLabel{{ $coupon->id }}">
                                                Confirmar
                                                eliminación</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Estás seguro que deseas eliminar el cupón
                                            <strong>{{ $coupon->name }}</strong>?
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

                <tr hidden id="edit{{ $coupon->id }}" class="edit">
                    <td>{{ $coupon->id }}</td>
                    <form method="POST" action="{{ route('coupons.update', $coupon->id) }}">
                        @method('PATCH')
                        @csrf

                        <td><input type="text" name="name" value="{{ $coupon->name }}"></td>
                        <td><input type="datetime-local" name="expiration" value="{{ $coupon->expiration }}"></td>
                        <td><input type="number" name="quantity" value="{{ $coupon->quantity }}"></td>
                        <td><input type="number" name="discount" value="{{ $coupon->discount }}"></td>
                        <td><input type="checkbox" name="active" {{ $coupon->active ? 'checked' : '' }}></td>

                        <td>
                            @php
                                $selectedProducts = $coupon->products->pluck('id')->toArray();
                            @endphp
                            @foreach ($coupon->products as $product)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="products[]"
                                        value="{{ $product->id }}" id="product{{ $product->id }}"
                                        {{ in_array($product->id, $selectedProducts) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="product{{ $product->id }}">
                                        {{ $product->name }}
                                    </label>
                                </div>
                            @endforeach
                        </td>

                        <td>
                            @foreach ($categories as $category)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="categories[]"
                                        value="{{ $category->id }}" id="category{{ $category->id }}"
                                        {{ $coupon->categories->contains($category->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="category{{ $category->id }}">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach

                        </td>
                        <td>
                            <button onclick="edit({{ $coupon->id }})" class="btn btn-primary">Save changes</button>
                    </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>


    @if ($coupons->lastPage() > 1)
        <nav>
            <ul class="pagination justify-content-center">
                {{-- Botón "anterior" --}}
                <li class="page-item {{ $coupons->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $coupons->previousPageUrl() }}" aria-label="Anterior">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                {{-- Mostrar los enlaces de las páginas --}}
                @for ($i = 1; $i <= $coupons->lastPage(); $i++)
                    <li class="page-item {{ $coupons->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $coupons->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                {{-- Botón "siguiente" --}}
                <li class="page-item {{ $coupons->currentPage() == $coupons->lastPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $coupons->nextPageUrl() }}" aria-label="Siguiente">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    @endif

    <div class="d-flex justify-content-center flex-column align-items-center bg-secondary text-white text-center">
        <div class="w-75 d-flex justify-content-center flex-column align-items-center">
            <h4>Crear un nuevo cupón</h4>
            <form action="{{ route('coupons.store') }}" method="POST"
                class="w-100 d-flex justify-content-center flex-column align-items-center">
                @csrf

                <div class="form-group">
                    <div class="d-lg-flex align-items-center gap-3 my-3">
                        <div>
                            <label for="name" class="form-label me-2">Nombre del cupón:</label>
                            <input class="form-control me-2" type="text" name="name" placeholder="Nombre del cupón">
                        </div>
                        <div>
                            <label for="expiration" class="form-label me-2">Fecha de vencimiento:</label>
                            <input class="form-control me-2" type="datetime-local" name="expiration">
                        </div>

                        <div>
                            <label for="quantity" class="form-label me-2">Número de aplicaciones:</label>
                            <input class="form-control me-2" type="number" name="quantity" placeholder="100">
                        </div>

                        <div>
                            <label for="discount" class="form-label me-2">% de descuento:</label>
                            <input class="form-control me-2" type="number" name="discount" placeholder="30">
                        </div>

                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <label for="activeCheckbox">Activo</label>
                            <input class="form-check-input" type="checkbox" name="active" id="activeCheckbox" checked>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Añadir</button>
            </form>
        </div>
    </div>
@endsection
