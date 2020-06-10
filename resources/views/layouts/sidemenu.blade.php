<!-- Start Side Menu -->
<section class='side-menu' id='sideMenu' dir='rtl'>
    <div class='side-menu-con' style='opacity: 1;'>
        <div class='close-menu'>
            <button class='btn'>
                <i class='fas fa-times'></i>
                {{ __('lang.close') }}
            </button>
        </div>
        <div class='logo'>
            <a href="/">
                <img src='{{ asset('images/gotogather-logo.png') }}' alt='Go To Gather Logo' class='img-fluid'>
            </a>
            <h4 class='welcoming-head'></h4>
        </div>
        <ul class='sections'>

            @auth
            <li class='section-con'>
                <a href='{{ route('profile') }}'>
                    <i class='fas fa-user-circle'></i>
                    <span> {{ auth()->user()->name }} </span>
                </a>
            </li>
            <li class='section-con'>
                <a href='{{ route('messenger.index') }}'>
                    <i class='fab fa-facebook-messenger'></i>
                    <span> {{ __('lang.chat') }} </span>
                </a>
            </li>
            <li class='section-con'>
                <a href='{{ route('groups.create') }}'>
                    <i class='fas fa-plus-circle'></i>
                    <span> {{ __('lang.createGroup') }} </span>
                </a>
            </li>
            <li class='section-con'>
                <a href='{{ route('groups.search') }}'>
                    <i class='fas fa-search'></i>
                    <span> {{ __('lang.findGroup') }} </span>
                </a>
            </li>
            <li class='section-con'>
                <a href='{{ route('groups.index') }}'>
                    <i class='fas fa-users'></i>
                    <span> {{ __('lang.groups') }} </span>
                </a>
            </li>
            <li class='section-con'>
                <a href='#'>
                    <i class='fas fa-bell'></i>
                    <span> {{ __('lang.notifications') }} </span>
                </a>
            </li>

            <li class='section-con'>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class='nav-link p-0 bg-transparent' type="submit">
                        <i class="fas fa-sign-out-alt text-white"></i>
                        <span> {{ __('lang.logout') }} </span>
                    </button>
                </form>
            </li>

            @else
            <li class='section-con'>
                <a href='{{ route('login') }}'> {{ __('lang.login') }} </a>
            </li>
            <li class='section-con'>
                <a href='{{ route('register') }}'> {{ __('lang.register') }} </a>
            </li>
            @endauth

            <li class='section-con'>
                <a href='#'> {{ __('lang.conditionsTerms') }} </a>
            </li>
            <li class='section-con'>
                <a href='#'> {{ __('lang.privacyPolicy') }} </a>
            </li>
        </ul>
    </div>
</section>
<!-- End Side Menu -->
