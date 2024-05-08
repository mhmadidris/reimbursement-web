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

    {{-- Livewire Style --}}
    @livewireStyles
</head>

<body>
    <div id="app">
        @include('layouts.navbar')

        <main class="min-vh-100" style="background-color: #000088;">
            @yield('content')
        </main>
    </div>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select the button and the chat box
            var button = document.getElementById('back-to-top');
            var chatBox = document.getElementById('chat1');

            // Add click event listener to the button
            button.addEventListener('click', function() {
                // Toggle the class 'show' to trigger fade-in/fade-out
                chatBox.classList.toggle('show');
                // Change the icon based on the class 'show'
                var icon = chatBox.classList.contains('show') ? 'fa-solid fa-times' :
                    'fa-solid fa-question';
                button.innerHTML = `<i class="${icon} fa-lg"></i>`;
            });
        });
    </script> --}}

    {{-- Start Pusher Custom Script --}}
    <script src="{{ asset('js/realtime.js') }}"></script>
    {{-- End Pusher Custom Script --}}

    {{-- Start CoreUI --}}
    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
    {{-- End CoreUI --}}

    {{-- Start Custom Script --}}
    <script src="{{ asset('js/script.js') }}"></script>
    {{-- End Custom Script --}}

    {{-- Start Sweetalert Scripts --}}
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script src="{{ asset('js/toast-alert.js') }}"></script>
    @include('sweetalert::alert')
    {{-- End Sweetalert Scripts --}}

    {{-- Livewire Script --}}
    @livewireScripts

</body>

</html>
