@extends('layouts.layout')

@section('title', 'Home')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mb-4">¡Gracias por su Compra!</h1>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Su compra se ha realizado con éxito. Agradecemos su preferencia.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-6">
                <img class="logo" src="" alt="NRP">
                <div class="company-info">
                    <h2>NRP</h2>
                    <p>Torre Sevilla</p>
                    <p>Sevilla, 41009</p>
                    <p>+34 955 555 555</p>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <h1 class="title">Factura</h1>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <p><strong>Número de pedido:</strong> {{ $orderData['order_id'] }}</p>
                <p><strong>Fecha:</strong> {{ $orderData['invoice']->date }}</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderData['order']->products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->pivot->amount }}</td>
                            <td>{{ number_format(($product->price * (1 + ($product->tax->amount / 100))), 2) }}€</td>
                            <td>{{ number_format($product->pivot->amount * ($product->price * (1 + ($product->tax->amount / 100))), 2) }}€</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-right">Total</th>
                            <td>{{ number_format($orderData['invoice']->total, 2) }}€</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <a href="{{ route('invoice.show') }}" target="_blank" class="btn btn-primary">Descargar Factura</a>
            </div>
        </div>
        

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="footer">
                    <p>Gracias por su compra.</p>
                    <p>Para cualquier consulta, no dude en contactarnos.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
