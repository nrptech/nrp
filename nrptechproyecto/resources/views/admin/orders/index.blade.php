@extends('layouts.admin')

@section('title', 'Pedidos')

@section('links')
    <script defer src="{{ asset('js/edit.js') }}"></script>
    <script defer src="{{ asset('js/apply.js') }}"></script>
@endsection

@section('content')
    <h2>Pedidos</h2>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Id</th>
                <th>Id del usuario</th>
                <th>Fecha del pedido</th>
                <th>Id Factura</th>
                <th>Estado del pedido</th>
                <th>Gestionar</th>
            </tr>
            @foreach ($orders as $order)
                <tr id="view{{ $order->id }}" class="view">
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user_id }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->invoice->id }}</td>
                    <td>{{ $order->state }}</td>
                    <td>
                        <button onclick="edit({{ $order->id }})" class="btn btn-success">Cambiar estado</button>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invoiceModal">Factura</button>

                        <!-- Modal -->
                        <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="invoiceModalLabel">Detalles de la Factura</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($order->invoice)
                                            <p>ID de la Factura: {{ $order->invoice->id }}</p>
                                            <p>Productos:</p>
                                            @foreach ($order->products as $product)
                                            <a href="{{ route('products.show', $product->id) }}"><span>ID:{{ $product->id }} </span>{{ $product->name }}</a>
                                            @endforeach
                                            <h5>Precio total: {{number_format($order->invoice->total, 2, '.', ',')}}€</h5>
                                        @else
                                            <p>No hay factura disponible para este pedido.</p>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr hidden id="edit{{ $order->id }}" class="edit">
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user_id }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->invoice->id }}</td>
                    <form method="POST" action="{{ route('orders.update', $order->id) }}">
                        @method('PATCH')
                        @csrf
                        <td>
                            <select name="state" id="state">
                                <option value="cancelled"@if ($order->state == 'cancelled') selected @endif>cancelled
                                </option>
                                <option value="pending" @if ($order->state == 'pending') selected @endif>pending</option>
                                <option value="delivered" @if ($order->state == 'delivered') selected @endif>delivered
                                </option>
                            </select>
                        <td>
                            <button onclick="edit({{ $order->id }})" class="btn btn-primary">Guardar cambios</button>
                        </td>
                    </form>
                </tr>
            @endforeach
        </table>
    </div>


    @if ($orders->lastPage() > 1)
        <nav>
            <ul class="pagination justify-content-center">
                {{-- Botón "anterior" --}}
                <li class="page-item {{ $orders->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $orders->previousPageUrl() }}" aria-label="Anterior">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                {{-- Mostrar los enlaces de las páginas --}}
                @for ($i = 1; $i <= $orders->lastPage(); $i++)
                    <li class="page-item {{ $orders->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $orders->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                {{-- Botón "siguiente" --}}
                <li class="page-item {{ $orders->currentPage() == $orders->lastPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $orders->nextPageUrl() }}" aria-label="Siguiente">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    @endif

@endsection
