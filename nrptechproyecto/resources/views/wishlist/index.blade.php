@extends('layouts.layout')

@section('title', 'Wishlist')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1 class="mb-4">Mi Lista de Deseos</h1>

                @if (count($wishlistItems) > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wishlistItems as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>
                                        <a href="{{ route('wishlist.remove', ['product' => $item->id]) }}"
                                            class="btn btn-danger btn-sm">Eliminar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No tienes productos en tu lista de deseos.</p>
                @endif

            </div>
        </div>
    </div>
@endsection
