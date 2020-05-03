<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @yield('metatag')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('front/images/logo-icon.png') }}" type="image/png" sizes="16x16">

    <title>{{ __('lang.websiteName') }}</title>

    <link rel="stylesheet" href="/css/app.css">


</head>

<!-- class="rtl" -->
<body class="{{ $currentLangDir == 'rtl' ? 'rtl' : ''  }}">

    {{-- Navbar --}}
    @include('layouts.navbar')

    @yield('content')

    <!--Start Footer -->
    <!--End Footer -->

   <script src="/js/app.js"></script>

    @yield('script')

</body>
</html>
