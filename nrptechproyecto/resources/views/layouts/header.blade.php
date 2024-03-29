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
    <link rel="stylesheet" href="{{ asset('styles/footer.css') }}">


    @yield('links')

</head>

<body class="@yield('bodyClasses')">

    <header class="p-3 mb-3 border-bottom d-flex align-items-center w-100 bg-lightBlue">
        @role('admin')
            <a href="{{ route('admin') }}" class="btn btn-warning">@lang('messages.adm')</a>
        @endrole

        <section class="d-flex justify-content-around align-items-center w-100 navItems">

            <a href="/home" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none mainLogo">
                <img src="{{ asset('images/nrplogo.png') }}" alt="NrpLogo" width="50" height="auto" />
            </a>

            <a href="{{ route('products.index') }}" class="btn btn-primary">@lang('messages.products')</a></li>

            <div class="d-flex align-items-center categoriasSearch">

                <form class="">
                    <input type="search" class="form-control" placeholder=@lang('messages.Search') aria-label="Search">
                </form>

            </div>

            <div class="dropdown text-end">
                <a href="{{ route('cart.show') }}" class="d-block link-dark text-decoration-none dropdown-toggle"
                    id="dropdownCart" data-bs-toggle="dropdown" aria-expanded="false">
                    @lang('messages.cart') @if (Auth::user() && Auth::user()->cart && Auth::user()->cart->products->count() > 0)
                        <span class="badge bg-danger">{{ Auth::user()->cart->products->count() }}</span>
                    @endif
                </a>
                <ul class="dropdown-menu text-smaller" aria-labelledby="dropdownUser1">
                    @if (Auth::user() && Auth::user()->cart && Auth::user()->cart->products->count() > 0)
                        @foreach (Auth::user()->cart->products as $product)
                            @php
                                $totalPrice = 0;
                                $basePrice = $product->price;
                                $afterTaxes = 0;
                                if (optional($product->coupon)->discount > 0 && optional($product->coupon)->active) {
                                    $afterTaxes = $product->price * ((100 - optional($product->coupon)->discount) / 100) * (1 + $product->tax->amount / 100);
                                } else {
                                    $afterTaxes = $product->price * (1 + $product->tax->amount / 100);
                                }

                                $totalPrice += $afterTaxes * $product->pivot->amount;
                            @endphp
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $product->name }} X {{ $product->pivot->amount }}</span>
                                <span>
                                    {{ number_format($totalPrice, 2) }}€
                                </span>
                            </li>
                        @endforeach
                    @else
                        <li>El carrito está vacío</li>
                    @endif

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li><a href="{{ url('/cart') }}" class="dropdown-item px-2 link-dark">@lang('messages.goCart')</a></li>

                </ul>
            </div>
            </div>

            @if (request()->is('home'))
                <!-- Language Switcher -->
                <div>
                    <form action="{{ route('switch.language', 'en') }}" method="get" style="display:inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-link"
                            {{ Auth::user()->language == 'en' ? 'disabled' : '' }}>
                            @lang('messages.langEn')
                        </button>
                    </form>

                    <span>|</span>

                    <form action="{{ route('switch.language', 'es') }}" method="get" style="display:inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-link"
                            {{ Auth::user()->language == 'es' ? 'disabled' : '' }}>
                            @lang('messages.langEsp')
                        </button>
                    </form>
                </div>
            @endif


            <div class="d-flex align-items-center gap-5">
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('images/nrplogo.png') }}" alt="mdo" width="32" height="32"
                            class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.index') }}">@lang('messages.profile')</a>

                        </li>
                        <li><a class="dropdown-item" href="{{ route('wishlist.index') }}">@lang('messages.Wishlist')</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                @lang('messages.logout')
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
