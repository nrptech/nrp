@extends('layouts.layout')

@section('title', 'Productos')

@section('links')
    <script defer src="{{ asset('js/productIndex.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('styles/products.css') }}">
@endsection

@section('bodyClasses')
    bg-products
@endsection

@section('content')

    <article class="allProductsViewIndex d-flex row justify-content-center mx-5">
        @foreach ($products as $product)
            <section class="productContainer">
                <div class="productImages d-flex align-content-center bg-lightBlue w-100 position-relative">
                    @if (count($product->images) > 1)
                        <button class="leftArrow position-absolute h-100 imgButton"
                            onclick="changeImg({{ $product->id }}, -1)">
                            < </button>
                    @endif

                    @foreach ($product->images as $key => $image)
                        <img hidden src="{{ asset("$image->url") }}" alt="{{ $product->name }}" class="w-100"
                            id="img{{ $product->id }}-{{ $key }}">
                    @endforeach

                    @if (count($product->images) > 1)
                        <button class="rightArrow position-absolute h-100 imgButton"
                            onclick="changeImg({{ $product->id }}, 1)">>
                        </button>
                    @endif
                </div>
                <div class="bg-white text-center d-flex flex-column descriptionContainer">
                    <h5>{{ $product->name }}</h5>
                    @if ($product->discount > 0)
                        <p class="card-text mb-0"><strong>Precio rebajado:</strong><span class="text-danger">
                                {{ number_format($product->price * ((100 - $product->discount) / 100) * (1 + $product->tax->amount / 100), 2) }}€</span>
                        <p class="card-text m-0 text-muted">Precio original:<span
                                class="text-decoration-line-through text-muted">
                                {{ number_format($product->price * (1 + $product->tax->amount / 100), 2) }}€</span>
                        </p>
                        <p class="card-text"><strong>Descripción:</strong> {{ $product->description }}</p>
                    @else
                        <p class="card-text"><strong>Precio:</strong>
                            {{ number_format($product->price * (1 + $product->tax->amount / 100), 2) }}€</p>
                        <p class="card-text"><strong>Descripción:</strong> {{ $product->description }}</p>
                    @endif
                    <div class="d-flex justify-content-around">
                        <a href="{{ route('products.show', $product) }}" class="btn btn-primary px-1 py-0">Ver producto</a>
                        <form action="{{ route('cart.add', $product) }}" method="post">
                            @csrf
                            <input hidden type="number" name="amount" value="1" min="1"
                                class="form-control mb-2">
                            <button type="submit" class="btn btn-success px-1 py-0">Añadir al carrito</button>
                        </form>

                        <form action="{{ route('wishlist.add', $product) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-info px-1 py-0">Añadir a Wishlist</button>
                        </form>
                        
                    </div>
                </div>
            </section>
        @endforeach
    </article>

@endsection
