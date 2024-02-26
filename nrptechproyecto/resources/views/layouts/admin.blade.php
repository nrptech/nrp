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

    @yield('links')
</head>

<body>
    <header>
        <nav class="d-flex justify-content-around p-4 bg-secondary">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Gestionar Usuarios</a>
            <a class="btn btn-primary" href="{{ route('productos.index') }}"> Gestionar Productos</a>
            <a class="btn btn-primary" href="{{ route('coupons.index') }}"> Gestionar cupones</a>
            <a class="btn btn-primary" href="{{ route('categories.index') }}">Gestionar categorias</a>
            <a href="{{ url('/home') }}" class="btn btn-warning">Vista de usuario</a>
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
