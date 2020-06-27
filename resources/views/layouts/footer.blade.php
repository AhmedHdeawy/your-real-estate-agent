<footer>
    <nav class='navbar'>
        <a class='navbar-brand' href='/'>
            <img src='{{ asset('images/gotogather-logo.png') }}' alt='Go To Gather Logo' class='img-fluid'>
        </a>
        <ul class='navbar-nav'>
            <li class='nav-item'>
                {{-- {{ __('lang.footerText') }} --}}
                <a href='#'> {{ __('lang.conditionsTerms') }} </a>
                <b class="text-white">-</b>
                <a href='#'> {{ __('lang.privacyPolicy') }} </a>
                <b class="text-white">-</b>
                {{ __('lang.poweredBy') }} :
                <a href="#">404Coders</a>
            </li>
        </ul>
    </nav>
</footer>
