@extends('layouts.layout')
@section('title', 'Wishlist')
@section('links')
    <!-- Replace the Bootstrap 4 link with Bootstrap 5 links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="{{ asset('js/home.js') }}"></script>
    <!-- Include Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('styles/wishlist.css') }}">
@endsection
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
                            <div class="imgMiniature mx-auto">
                                @if ($product->images->isNotEmpty())
                                    <img src="{{ asset($product->images->first()->url) }}" alt="{{ $product->name }}" class="img-fluid" id="img{{ $product->id }}-0">
                                @endif
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <span class="d-block">{{ $product->name }}</span>
                                <span class="d-block">$ {{ $product->price }}</span>
                            </div>
                            <div class="d-flex flex-column align-items-end">
                                <a href="{{ route('products.show', $product) }}" class="btn btn-warning mb-2">
                                    <i class="fas fa-search"></i> Visitar
                                </a>
                                <form action="{{ route('wishlist.remove', ['productId' => $product->id]) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Quitar de Wishlist</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                @endforeach
            </ul>
        @else
            <p class="mt-3">No hay productos en la Wishlist.</p>
        @endif
    </div>
@endsection
