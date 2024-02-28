@extends('layouts.layout')

@section('title', 'Productos')

@section('links')
    <script defer src="{{ asset('js/productIndex.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('styles/products.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha384-/r/jvESa4HJom5SvijYkUuu92t3Xh7LQQi20ZcpaAgU8ydYh5Tc9Huk1MzVeZaZ7" crossorigin="anonymous">
@endsection

@section('bodyClasses')
    bg-products
@endsection

@section('content')
    <div class="container mt-5">
        <form action="{{ route('products.filter') }}" method="post" class="mb-3">
            @csrf
            <div class="mb-3">
                <label for="category" class="form-label">Categoría:</label>
                <select name="category" id="category" class="form-select">
                    <option value="">Ver todo</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($products as $product)
                @if ($product->visible)
                    <div class="col">
                        <div class="card h-100">
                            <div class="productImages position-relative overflow-hidden">
                                <img src="{{ asset($product->images->first()->url) }}" alt="{{ $product->name }}"
                                    class="w-100" id="img{{ $product->id }}">
                            </div>
                            <div class="card-body">
                                <a class="h6 text-decoration-none text-truncate"
                                    href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    @if (optional($product->coupon)->discount > 0 && optional($product->coupon)->active)
                                        <p class="card-text mb-0"><strong>Precio rebajado:</strong><span
                                                class="text-danger">
                                                {{ number_format($product->price * ((100 - optional($product->coupon)->discount) / 100) * (1 + $product->tax->amount / 100), 2) }}€</span>
                                        <p class="card-text m-0 text-muted">Precio original:<span
                                                class="text-decoration-line-through text-muted">
                                                {{ number_format($product->price * (1 + $product->tax->amount / 100), 2) }}€</span>
                                        </p>
                                    @else
                                        <p class="card-text"><strong>Precio:</strong>
                                            {{ number_format($product->price * (1 + $product->tax->amount / 100), 2) }}€
                                        </p>
                                    @endif
                                </div>
                                <p class="mb-1">
                                    Descripción:
                                    {{ $product->description }}
                                </p>
                                <div class="d-flex justify-content-around mt-3">
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-warning btn-square">
                                        <i class="fas fa-search">🔎</i> <!-- Magnifying glass icon -->
                                    </a>
                                    <form action="{{ route('cart.add', $product) }}" method="post">
                                        @csrf
                                        <input hidden type="number" name="amount" value="1" min="1"
                                            class="form-control mb-2">
                                        <button type="submit" class="btn btn-primary btn-square">
                                            <i class="fas fa-shopping-cart">🛒</i> <!-- Shopping cart icon -->
                                        </button>
                                    </form>
                                    <form action="{{ route('wishlist.add', $product) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-square">
                                            <i class="fas fa-heart">♡</i> <!-- Heart icon -->
                                        </button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
