@extends('layouts.layout')

@section('title', 'Wishlist')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1 class="mb-4">Mi Lista de Deseos</h1>

                @if(count($wishlistItems) > 0)
                    <ul class="list-group">
                        @foreach($wishlistItems as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $item->name }}
                                <span>
                                    <a href="{{ route('wishlist.remove', ['product' => $item->id]) }}"
                                       class="btn btn-danger btn-sm">Eliminar</a>
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No tienes productos en tu lista de deseos.</p>
                @endif

            </div>
        </div>
    </div>
@endsection
