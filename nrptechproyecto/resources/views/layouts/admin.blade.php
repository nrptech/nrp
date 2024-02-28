<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- Bootstrap CSS with custom styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    
    <!-- Bootstrap JS with Popper.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <!-- Bootstrap JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
<link rel="stylesheet" href="{{ asset('styles/adminLayout.css') }}">

    <link rel="stylesheet" href="{{asset('styles/header.css')}}">
    @yield('links')
</head>

<body>
    <header>
        <nav class="d-flex justify-content-around p-4 bg-primary"> <!-- Use primary blue color -->
            <a class="btn btn-light" href="{{ route('users.index') }}"> Gestionar Usuarios</a> <!-- Light button -->
            <a class="btn btn-light" href="{{ route('productos.index') }}"> Gestionar Productos</a>
            <a class="btn btn-light" href="{{ route('coupons.index') }}"> Gestionar Cupones</a>
            <a class="btn btn-light" href="{{ route('categories.index') }}">Gestionar Categorias</a>
            <a href="{{ url('/home') }}" class="btn btn-warning">Vista de Usuario</a>
        </nav>
    </header>
    
    
    <main class="container mt-4"> <!-- Add margin top for content -->
        @yield('content')
    </main>

    <footer class="main-footer mt-5">
        <strong>Copyright © NRPtech 2024 All rights reserved.</strong>
    </footer>
</body>

</html>
