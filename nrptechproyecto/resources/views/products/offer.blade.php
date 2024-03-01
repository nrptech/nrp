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
                        <p class="card-text">{{ number_format($afterTaxes = $product->price * (1 + $product->tax->amount / 100), 2, '.', ',') }}€</p>
                    </div>
                    <a href="{{ route('products.show', $product) }}" class="btn btn-warning btn-block">
                        <i>🔎</i> Visitar
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
