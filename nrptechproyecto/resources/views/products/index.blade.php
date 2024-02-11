@extends('layouts.layout')

@section('title', 'Productos')

@section('links')
    <script defer src="{{ asset('js/productIndex.js') }}"></script>
@endsection

@section('content')
    <div class="container mt-4">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-6 mb-4 productContainer product{{ $product->id }}">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <div class="productImages d-flex w-100 justify-content-center align-content-center">
                                @if (count($product->images) > 1)
                                    <button class="leftArrow" onclick="changeImg({{ $product->id }}, -1)">
                                    </button>
                                @endif

                                @foreach ($product->images as $key => $image)
                                    <img hidden src="{{ asset("$image->url") }}" alt="{{ $product->name }}"
                                        class="img-fluid mb-2" id="img{{ $product->id }}-{{ $key }}">
                                @endforeach

                                @if (count($product->images) > 1)
                                    <button class="rightArrow" onclick="changeImg({{ $product->id }}, 1)">
                                    </button>
                                @endif
                            </div>
                            @if ($product->discount > 0)
                                <h4 class="badge text-warning">¡Estamos de oferta!</h4>
                                <p>Rebaja del {{ $product->discount }}%</p>
                                <p class="card-text">Precio original:<span class="text-decoration-line-through text-danger">
                                        {{ number_format($product->price * (1 + $product->tax->amount / 100), 2) }}€</span>
                                </p>
                                <p class="card-text"><strong>Precio rebajado:</strong><span class="text-success">
                                        {{ number_format($product->price * ((100 - $product->discount) / 100) * (1 + $product->tax->amount / 100), 2) }}€</span>
                                <p class="card-text"><strong>Descripción:</strong> {{ $product->description }}</p>
                                <a href="{{ route('products.show', $product) }}" class="btn btn-primary">Ver
                                    producto</a>
                            @else
                                <p class="card-text"><strong>Precio:</strong>
                                    {{ number_format($product->price * (1 + $product->tax->amount / 100), 2) }}€</p>
                                <p class="card-text"><strong>Descripción:</strong> {{ $product->description }}</p>
                                <a href="{{ route('products.show', $product) }}" class="btn btn-primary">Ver
                                    producto</a>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
