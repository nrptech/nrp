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

    <script defer src="{{ asset('path-to-your-js/languageSwitcher.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('styles/header.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/footer.css') }}">

    @yield('links')

</head>

<body class="@yield('bodyClasses')">

    <header class="p-3 mb-3 border-bottom d-flex align-items-center w-100 bg-lightBlue">

        <section class="d-flex justify-content-around align-items-center w-100 navItems">

            <a href="/home" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none mainLogo">
                <img src="{{ asset('images/nrplogo.png') }}" alt="NrpLogo" width="50" height="auto" />
            </a>

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    @switch(session('language'))
                        @case('en')
                            <img src="{{ asset('images/reino-unido.png') }}" width="25px"> English
                        @break
            
                        @case('es')
                            <img src="{{ asset('images/espana.png') }}" width="25px"> Español
                        @break
            
                        @default
                            <img src="{{ asset('images/reino-unido.png') }}" width="25px"> English
                    @endswitch
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <form action="{{ route('switch.language', 'en') }}" method="get">
                        @csrf
                        <input type="hidden" name="language" value="en" />
                        <button type="submit" class="dropdown-item"
                            {{ session('language') == 'en' ? 'disabled' : '' }}>English</button>
                    </form>
            
                    <form action="{{ route('switch.language', 'es') }}" method="get">
                        @csrf
                        <input type="hidden" name="language" value="es" />
                        <button type="submit" class="dropdown-item"
                            {{ session('language') == 'es' ? 'disabled' : '' }}>Español</button>
                    </form>
                </div>
            </div>
            

            <div class="d-flex align-items-center gap-5">
                @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                        @auth
                            <a href="{{ url('/home') }}"
                                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                                in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </section>
    </header>

    <main>
