@extends("layouts.layout")

@section("title", "Home")

@section('links')
    <!-- Replace the Bootstrap 4 link with Bootstrap 5 links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="{{ asset('js/home.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('styles/home.css') }}">
    <!-- Include Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')
<div class="container mt-5">
    <div class="row mt-4">
        <div class="col-md-12">
            <h2>Explorar por Categorías</h2>
            <!-- Aquí puedes mostrar un menú o cuadrícula de categorías -->
            <!-- Puedes utilizar Bootstrap Cards, List Group, u otras opciones según tu diseño -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Mi Perfil</h5>
                    <p class="card-text">Editar tu perfil</p>
                    <a href="{{ route('profile.index') }}" class="btn btn-primary">Editar Perfil</a>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Historial de Compra</h5>
                    <p class="card-text">Ver tus compras anteriores</p>
                    <a href="{{ route('user.orders') }}" class="btn btn-primary">Ver Compras</a>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Lista de Deseos</h5>
                    <p class="card-text">Explorar tus productos deseados</p>
                    <a href="{{ route('wishlist.index') }}" class="btn btn-primary">Ver Lista de Deseos</a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
                @include('products.offer')
        </div>
    </div>
</div>
@endsection
