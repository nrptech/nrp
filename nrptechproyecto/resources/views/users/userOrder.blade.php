@extends("layouts.layout")

@section("title", "Orders")

@section('links')

<style>
    div {
        max-width: 800px;
        margin: 0 auto;
    }

    h2, h3 {
        color: #333;
    }

    .order {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 20px;
    }

    .products {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .product {
        text-align: center;
        margin: 0;
    }

    img {
        max-width: 100%;
        height: auto;
    }
</style>

@section('content')
<div>
    <h2>Mis Pedidos</h2>
    
    @foreach ($user->orders as $order)
        <article class="order">
            <h3>Referencia del pedido: {{ $order->id }}</h3>
            
            <div class="products">
                @foreach ($order->products as $product)
                    <figure class="product">
                        <img src="{{ $product->images->first()->url }}" alt="{{ $product->name }}">
                        <figcaption>{{ $product->name }}</figcaption>
                    </figure>
                @endforeach
            </div>
            
            <p>Estado del pedido: {{ $order->state }}</p>
            
            <p>
                @if ($order->invoice)
                    Precio total del pedido: {{ $order->invoice->total }}
                @endif
            </p>
        </article>
    @endforeach
</div>

@endsection