@extends('layouts.layout')
@section('title', 'Wishlist')

@section('content')
    <div class="container mt-5">
        <h1>Wishlist</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($wishlistProducts->isNotEmpty()) 
            <ul class="list-group mt-3">
                @foreach($wishlistProducts as $wishlist) 
                    @foreach($wishlist->products as $product) 
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                {{ $product->name }} - ${{ $product->price }}
                            </span>
                            <form action="{{ route('wishlist.remove', ['productId' => $product->id]) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger">Quitar de Wishlist</button>
                            </form>
                        </li>
                    @endforeach
                @endforeach
            </ul>
        @else
            <p class="mt-3">No hay productos en la Wishlist.</p>
        @endif
    </div>
@endsection
