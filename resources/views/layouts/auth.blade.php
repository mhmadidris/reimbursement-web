<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="robots" content="noindex, nofollow">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}

    <title>@yield('title') - {{ env('APP_NAME') }}</title>

    {{-- CoreUI --}}
    <link rel="stylesheet" href="{{ asset('css/coreui.min.css') }}">

    {{-- jQuery --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    {{-- Owl Carousel --}}
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'])

    {{-- Style Custom --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/boxed-check.css') }}">
    <link rel="stylesheet" href="{{ asset('css/boxed-check.min.css') }}">
</head>

<body>
    <div id="app">
        <main class="min-vh-100" style="background-color: #000088;">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>

    {{-- CoreUI --}}
    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
</body>

</html>
