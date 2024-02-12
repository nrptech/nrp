<header class="p-3 mb-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                    <use xlink:href="#bootstrap"></use>
                </svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li><a href="#" class="nav-link px-2 link-secondary"> @lang('messages.overview')</a></li>
            <li><a href="#" class="nav-link px-2 link-dark"> @lang('messages.inventory')</a></li>
            <li><a href="{{url("/cart")}}" class="nav-link px-2 link-dark"> @lang('messages.cart')</a></li>
            <li><a href="{{ url('/products') }}" class="nav-link px-2 link-dark"> @lang('messages.products')</a></li>
            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
            </form>
            
<div>
    <form action="{{ route('switch.language', 'en') }}" method="post" style="display:inline-block;">
        @csrf
        <button type="submit" class="btn btn-link">English</button>
    </form>

    <span>|</span>

    <form action="{{ route('switch.language', 'es') }}" method="post" style="display:inline-block;">
        @csrf
        <button type="submit" class="btn btn-link">Español</button>
    </form>
</div>
            <div class="dropdown text-end">
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32"
                        class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="#">New project...</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            @lang('messages.Logout')
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div> 
        </div>
    </div>
</header>