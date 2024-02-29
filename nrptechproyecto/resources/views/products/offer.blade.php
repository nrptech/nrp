<style>
    .cardP {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-body {
        flex-grow: 1;
        margin-top: auto; /* Empuja el contenido hacia arriba */
    }

    .imgMiniature {
        text-align: center;
    }

    .imgMiniature img {
        max-width: 100%;
        max-height: 100%;
        height: auto;
        width: auto;
    }

    .btn-block {
        align-self: flex-end; /* Alinea el botón a la izquierda */
    }
</style>

<div class="container mt-5">
    <h2 class="text-center mb-4">Productos Destacados</h2>
    <div class="row">
        @php
            $randomProducts = App\Models\Product::inRandomOrder()->take(4)->get();
        @endphp

        @foreach ($randomProducts as $product)
            <div class="col-md-3 mb-4">
                <div class="card cardP">
                    <div class="imgMiniature mx-auto mt-3">
                        @if ($product->images->isNotEmpty())
                            <img src="{{ asset($product->images->first()->url) }}"
                                alt="{{ $product->name }}" class="img-fluid" id="img{{ $product->id }}-0">
                        @endif
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->price }},00 €</p>
                    </div>
                    <a href="{{ route('products.show', $product) }}" class="btn btn-warning btn-block">
                        <i>🔎</i> Visitar
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
