@extends('layouts.layout')

@section('title', "$product->name")

@section('links')
    <script defer src="{{ asset('js/productShow.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('styles/productView.css') }}">
@endsection

@section('bodyClasses')
    bg-products
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row g-5">
            <div class="col-md-6">
                <div class="main-img-container bg-primary mb-3">
                    @if ($product->images->isNotEmpty())
                        <img src="{{ asset($product->images->first()->url) }}" alt="{{ $product->name }}"
                            class="img-fluid w-100">
                    @endif
                </div>
                <div class="img-selector-container bg-dark d-flex justify-content-between">
                    <button class="left-arrow btn btn-dark">&lt;</button>
                    <div class="d-flex justify-content-around">
                        @foreach ($product->images as $key => $image)
                            <img src="{{ asset($image->url) }}" alt="{{ $image->url }}" id="img{{ $key + 1 }}"
                                class="img-fluid mb-2 w-25" onclick="changeImage(this)">
                        @endforeach
                    </div>
                    <button class="right-arrow btn btn-dark">&gt;</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="name-and-price-container bg-info text-center d-flex flex-column justify-content-around">
                    <h3 class="display-5 text-white">{{ $product->name }}</h3>
                    <h3>Availability:</h3>
                    @if ($product->stock > 0)
                        <p class="text-success fw-bold"> In Stock: {{ $product->stock }}</p>
                    @else
                        <p class="text-danger">Out of Stock</p>
                    @endif
                    @if ($product->discount > 0)
                        <h4 class="badge bg-warning text-dark">Special Offer!</h4>
                        <p>Discount: {{ $product->discount }}%</p>
                        <p class="card-text text-white">Original Price:
                            <span class="text-decoration-line-through text-danger">
                                {{ number_format($product->price * (1 + $product->tax->amount / 100), 2) }}€
                            </span>
                        </p>
                        <p class="card-text text-white">
                            <strong>Discounted Price:</strong>
                            <span class="text-success">
                                {{ number_format($product->price * ((100 - $product->discount) / 100) * (1 + $product->tax->amount / 100), 2) }}€
                            </span>
                        </p>
                    @else
                        <p class="card-text text-white">
                            <strong>Price:</strong>
                            {{ number_format($product->price * (1 + $product->tax->amount / 100), 2) }}€
                        </p>
                    @endif
                    <form action="{{ route('cart.add', $product) }}" method="post">
                        @csrf
                        <input hidden type="number" name="amount" value="1" min="1" class="form-control mb-2">
                        <button type="submit" class="btn btn-light">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="about">
                    <h2 class="display-5 text-primary">Product Description</h2>
                    <p>{{ $product->description }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="specs">
                    <h2 class="display-5 text-primary">Specifications</h2>
                    <p>{{ $product->specs }}</p>
                </div>
            </div>
        </div>
    </div>

@endsection
