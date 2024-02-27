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
    <article class="imagesAndPrice d-flex justify-content-between">
        <section class="images mx-5 mt-5">
            <div class="mainImg bg-danger">
                @if ($product->images->isNotEmpty())
                    <img src="{{ asset($product->images->first()->url) }}" alt="{{ $product->name }}"
                        class="img-fluid mb-2 w-100">
                @endif
            </div>
            <div class="imgSelector d-flex bg-black">
                <button class="leftArrow">
                </button>
                <div class="d-flex justify-content-around">
                    @foreach ($product->images as $key => $image)
                        <img src="{{ asset($image->url) }}" alt="{{ $image->url }}" id="img{{ $key + 1 }}"
                            class="img-fluid mb-2 w-25">
                    @endforeach
                </div>
                <button class="rightArrow">
                </button>
            </div>
        </section>
        <section class="nameAndPrice mx-5 mt-5 text-center bg-secondary d-flex flex-column justify-content-around">
            <h3>{{ $product->name }}</h3>

            <h3>Disponibilidad:</h3>
            @if ($product->stock > 0)
                <p class="text-success fw-bold"> {{ $product->stock }} En stock </p>
            @else
                <p class="text-danger">Fuera de stock</p>
            @endif

            @if(optional($product->coupon)->discount > 0 && optional($product->coupon)->active)
                <h4 class="badge text-warning">¡Estamos de oferta!</h4>
                <p>Rebaja del {{ optional($product->coupon)->discount }}%</p>
                <p class="card-text">Precio original:<span class="text-decoration-line-through text-danger">
                        {{ number_format($product->price * (1 + $product->tax->amount / 100), 2) }}€</span></p>
                <p class="card-text"><strong>Precio rebajado:</strong><span class="text-success">
                        {{ number_format($product->price * ((100 - optional($product->coupon)->discount) / 100) * (1 + $product->tax->amount / 100), 2) }}€</span>
                @else
                <p class="card-text"><strong>Precio:</strong>
                    {{ number_format($product->price * (1 + $product->tax->amount / 100), 2) }}€</p>
            @endif
            <form action="{{ route('cart.add', $product) }}" method="post">
                @csrf
                <input hidden type="number" name="amount" value="1" min="1" class="form-control mb-2">
                <button type="submit" class="btn btn-primary">Añadir al carrito</button>
            </form>
        </section>
    </article>
    <section class="specifications mx-5 mt-5">
        <div class="about">
            <h2>Descripción del producto</h2>
            <p>{{ $product->description }}</p>
        </div>
        <div class="specs">
            <h2>Especificaciones</h2>
            <p>{{ $product->specs }}</p>
        </div>
    </section>
@endsection
