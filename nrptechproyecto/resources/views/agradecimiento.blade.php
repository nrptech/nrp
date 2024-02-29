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
@endsection
