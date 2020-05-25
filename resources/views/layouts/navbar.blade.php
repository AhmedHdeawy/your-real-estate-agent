<nav class='navbar navbar-expand-md'>
    <a class='navbar-brand' href='/'>
        <img src='{{ asset('images/gotogather-logo.png') }}' alt='Go To Gather Logo' class='img-fluid'>
    </a>
    <button class='navbar-toggler' type='button'>
        <i class='fas fa-bars'></i>
    </button>
    <div class='collapse navbar-collapse' id='navbarSupportedContent'>

        @auth
            <ul class='navbar-nav'>
                <li class='nav-item mx-2'>
                    <a class='nav-link register-btn' href='{{ route('groups.index') }}'>
                        <i class="fas fa-user-friends text-white"></i>
                    </a>
                </li>

                <li class='nav-item mx-2'>
                    <a class='nav-link register-btn' href='{{ route('home') }}'>
                        {{ auth()->user()->name }}
                    </a>
                </li>
                <li class='nav-item'>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class='nav-link logout-btn register-btn' type="submit">
                            <i class="fas fa-sign-out-alt text-white"></i>
                        </button>
                    </form>
                </li>
                <li class='nav-item'>
                    <a class="nav-link register-btn" href="{{ str_replace( '/'.$localeLang.'/',  '/'.$localeLangInverse.'/', url()->full() ) }}">
                        {{ __('dashboard.'.$localeLangInverse.'.inverse') }}
                    </a>
                </li>
            </ul>
        @else
            <ul class='navbar-nav'>
                <li class='nav-item'>
                    <a class='nav-link' href='{{ route('login') }}'> {{ __('lang.login') }} </a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link register-btn' href='{{ route('register') }}'> {{ __('lang.register') }} </a>
                </li>
            </ul>
        @endauth
    </div>
</nav>
