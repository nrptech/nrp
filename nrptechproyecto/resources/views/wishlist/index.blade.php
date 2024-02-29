@extends('layouts.layout')
@section('title', 'Wishlist')

@section('content')
    <div class="container mt-5">
        <h1>Wishlist</h1>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
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
