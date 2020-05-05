<nav class='navbar navbar-expand-md'>
    <a class='navbar-brand' href='#'>
        <img src='images/gotogather-logo.png' alt='Go To Gather Logo' class='img-fluid'>
    </a>
    <button class='navbar-toggler' type='button'>
        <i class='fas fa-bars'></i>
    </button>
    <div class='collapse navbar-collapse' id='navbarSupportedContent'>
        <ul class='navbar-nav'>
            <li class='nav-item'>
                <a class='nav-link' href='{{ route('login') }}'> {{ __('lang.login') }} </a>
            </li>
            <li class='nav-item'>
                <a class='nav-link register-btn' href='{{ route('register') }}'> {{ __('lang.register') }} </a>
            </li>
        </ul>
    </div>
</nav>
