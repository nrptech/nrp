@extends("layouts.admin")

@section("title", "Cupones")

@section("links")
    <script defer src="{{asset("js/edit.js")}}"></script>
@endsection

@section("content")
    <h2>Cupones</h2>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Fecha de caducidad</th>
            <th>Cantidad de cupones</th>
            <th>% de descuento</th>
            <th>Estado</th>
            <th>Gestionar</th>
        </tr>
        @foreach ($coupons as $coupon)
           
            <tr id="view{{ $coupon->id }}">
                <td>{{ $coupon->id }}</td>
                <td>{{ $coupon->name }}</td>
                <td>{{ $coupon->expiration }}</td>
                <td>{{ $coupon->quantity }}</td>
                <td>{{ $coupon->discount }}</td>
                <td>{{($coupon->active ?  'Activo' : 'Inactivo')}}</td>
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
                                        <h5 class="modal-title" id="confirmDeleteModalLabel{{ $coupon->id }}">Confirmar
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
            <tr hidden id="edit{{ $coupon->id }}">
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
                        <button onclick="edit({{ $coupon->id }})" class="btn btn-primary">Save changes</button>
                </form>
                </td>
            </tr>
        @endforeach

    </table>
@endsection
