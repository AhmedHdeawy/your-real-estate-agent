<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset='UTF-8'>
    <meta name='theme-color' content='#363062'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">

    @yield('metatag')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('images/logo-icon.png') }}" type="image/png" sizes="16x16">

    <title>{{ __('lang.websiteName') }}</title>
    <link href='https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap' rel='stylesheet' as='font'>
    <script crossorigin='anonymous' src='https://kit.fontawesome.com/9a07467a57.js' async></script>
    <link rel="stylesheet" href="{{  mix('css/app.css') }}">
    @yield('style')
    <link rel="stylesheet" href="{{ mix('css/all.css') }}">
</head>

<!-- class="rtl" -->

<body dir="{{ $currentLangDir}}" style='text-align: right'>
    {{-- App Navbar --}}
    @include('layouts.navbar')
    {{-- App Navbar / End --}}

    <div class='content-wrapper'>

        {{-- Main Section --}}
        @yield('content')
        {{-- Main Section / End --}}

        {{-- Footer --}}
        @include('layouts.footer')
        {{-- Footer / End --}}
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ mix('js/all.js') }}"></script>

    @yield('script')

</body>

</html>
