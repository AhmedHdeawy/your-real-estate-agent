<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset='UTF-8'>
    <meta name='theme-color' content='#363062'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @yield('metatag')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('front/images/logo-icon.png') }}" type="image/png" sizes="16x16">

    <title>{{ __('lang.websiteName') }}</title>
    <link href='https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap' rel='stylesheet' as='font'>
    <script crossorigin='anonymous' src='https://kit.fontawesome.com/9a07467a57.js' async></script>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/custom.css">
    @yield('style')

    @auth
        <script>
            window.authedUser = {!! json_encode(auth()->user()) !!};
        </script>
    @endauth


</head>

<!-- class="rtl" -->
<body dir="{{ $currentLangDir == 'rtl' ? 'rtl' : 'ltr'  }}">

    <div class='container'>
        <div class='app-con'>

            {{-- App Navbar --}}
            @include('layouts.navbar')
            {{-- App Navbar / End --}}

            {{-- Main Section --}}
            <main class='page-content'>
                @yield('content')
            </main>
            {{-- Main Section / End --}}

            {{-- Footer --}}
            @include('layouts.footer')
            {{-- Footer / End --}}

        </div>
    </div>

    {{-- Mobile Navbar --}}
    @include('layouts.sidemenu')
    {{-- Mobile Navbar / End --}}

    {{-- Mobile Navbar --}}
    @include('layouts.mobile_navbar')
    {{-- Mobile Navbar / End --}}



   <script src="/js/app.js"></script>
   <script src="/js/custom.js"></script>

    @yield('script')

</body>
</html>
