<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="{{asset('styles/header.css')}}">
    @yield('links')
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-blue">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('admin') }}">Administración</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">Gestionar Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('productos.index') }}">Gestionar Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('coupons.index') }}">Gestionar Cupones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categories.index') }}">Gestionar Categorias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('orders.index') }}">Gestionar Pedidos</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a href="{{ url('/home') }}" class="btn btn-danger">Vista de usuario</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    
    
    <main>
        @yield('content')
    </main>

    <footer class="main-footer">
        <strong>Copyright © NRPtech 2024 All rights reserved.</strong>
    </footer>
</body>

</html>
