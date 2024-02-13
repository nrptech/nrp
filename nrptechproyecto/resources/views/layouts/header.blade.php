<!doctype html>
<html lang="es">

<head>
    <title>@yield('title')</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="{{ asset('styles/header.css') }}">



    @yield('links')

</head>

<body class="@yield('bodyClasses')">

    <header class="p-3 mb-3 border-bottom d-flex align-items-center w-100 bg-lightBlue">
        @role('admin')
        <a href="{{ route('admin') }}" class="btn btn-warning">Administrador</a>

        @endrole
        <section class="d-flex justify-content-around align-items-center w-100 navItems">

            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none mainLogo">
                <img src="{{ asset('images/nrplogo.png') }}" alt="NrpLogo" width="50" height="auto" />
            </a>

            <div class="d-flex align-items-center categoriasSearch">
                <div class="dropdown text-start categoriesDropdown">

                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle badge bg-primary"
                        id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false"> Categorias
                    </a>


                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                        <li><a href="{{ route('products.index') }}" class="nav-link px-2 link-dark">Todos los
                                productos</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        {{-- @foreach ($categories as $category)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $category->name }}
                            </li>

                            <!-- Puedes mostrar otros detalles del item aquí -->
                        @endforeach --}}

                    </ul>
                </div>

                <form class="">
                    <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                </form>

            </div>

                <div class="dropdown text-end">
                    <a href="{{ route('cart.show') }}" class="d-block link-dark text-decoration-none dropdown-toggle"
                        id="dropdownCart" data-bs-toggle="dropdown" aria-expanded="false">
                        Carrito @if (Auth::user() && Auth::user()->cart && Auth::user()->cart->products->count() > 0)
                            <span class="badge bg-danger">{{ Auth::user()->cart->products->count() }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu text-smaller" aria-labelledby="dropdownUser1">
                        @php
                            $totalPrice = 0;
                        @endphp
                        @if (Auth::user() && Auth::user()->cart && Auth::user()->cart->products->count() > 0)
                            @foreach (Auth::user()->cart->products as $product)
                                @php
                                    $basePrice = 0;
                                    $afterTaxes = 0;
                                    if ($product->discount > 0) {
                                        $basePrice = $product->price * ((100 - $product->discount) / 100);
                                        $afterTaxes = $product->price * ((100 - $product->discount) / 100) * (1 + $product->tax->amount / 100);
                                    } else {
                                        $basePrice = $product->price;
                                        $afterTaxes = $product->price * (1 + $product->tax->amount / 100);
                                    }
                                    $totalPrice += $afterTaxes * $product->pivot->amount;
                                @endphp

                                <li class="list-group-item d-flex justify-content-between align-items-center">

                                    <span>{{ $product->name }} X {{ $product->pivot->amount }}</span>


                                    <span>
                                        {{ number_format($afterTaxes * $product->pivot->amount, 2) }}€
                                    </span>

                                </li>

                                <!-- Puedes mostrar otros detalles del item aquí -->
                            @endforeach
                        @else
                            <li>No hay items en el carrito</li>
                        @endif

                        <li>
                            <hr class="dropdown-divider">
                        </li>


                        <li><a href="{{ url('/cart') }}" class="dropdown-item px-2 link-dark">Ir al carrito</a></li>

                    </ul>
                </div>
            </div>

            <div class="d-flex align-items-center gap-5">
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('images/nrplogo.png') }}" alt="mdo" width="32" height="32"
                            class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="#">Ajustes</a></li>
                        <li><a class="dropdown-item" href="#">Wishlist</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>

        </section>
    </header>


    <main>
