<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="robots" content="noindex, nofollow">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}

    <title>@yield('title') - {{ env('APP_NAME') }}</title>
    <meta name="theme-color" content="#ffffff">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'])

    {{-- CoreUI --}}
    <link rel="stylesheet" href="{{ asset('css/coreui.min.css') }}">

    {{-- jQuery --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    {{-- Style Custom --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/boxed-check.css') }}">
    <link rel="stylesheet" href="{{ asset('css/boxed-check.min.css') }}">

    {{-- CKEDITOR 5 --}}
    <script src="{{ asset('js/ckeditor.js') }}"></script>

    {{-- Select2 --}}
    <script src="{{ asset('js/select2.min.js') }}"></script>

    {{-- Livewire Style --}}
    @livewireStyles
</head>

<body>
    @php
        $locale = request()->segment(1);
    @endphp

    <div class="sidebar sidebar-fixed" id="sidebar">
        <div class="sidebar-brand d-none d-md-flex justify-content-start p-3">
            @if (Auth::check() && Auth::user()->hasRole('finance'))
                <div class="sidebar-brand-full">
                    <h6 class="m-0 fw-semibold">Dashboard</h6>
                    <h4 class="m-0 fw-bold">Finance</h4>
                </div>
            @elseif (Auth::check() && Auth::user()->hasRole('staff'))
                <div class="sidebar-brand-full">
                    <h6 class="m-0 fw-semibold">Dashboard</h6>
                    <h4 class="m-0 fw-bold">Staff</h4>
                </div>
            @else
                <div class="sidebar-brand-full">
                    <h6 class="m-0 fw-semibold">Dashboard</h6>
                    <h4 class="m-0 fw-bold">Director</h4>
                </div>
            @endif
        </div>
        @include('layouts.navigation')

        <a class="dropdown-item d-flex justify-content-center align-items-center gap-2 p-2"
            href="{{ route('logout', $locale) }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            style="color: white; background-color: red;">
            <i class="fa-solid fa-right-from-bracket"></i>
            <h6 class="m-0 text-white">Keluar</h6>
        </a>

        <form id="logout-form" action="{{ route('logout', $locale) }}" method="POST" class="d-none">
            @csrf
        </form>
        {{-- <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable">
        </button> --}}
    </div>
    <div class="wrapper d-flex flex-column min-vh-100" style="background-color: #000088;">
        {{-- <header class="header header-sticky mb-4 rounded-pill m-3">
            <div class="container-fluid">
                <button class="header-toggler px-md-0 me-md-3" type="button"
                    onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                    <svg class="icon icon-lg">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-menu') }}"></use>
                    </svg>
                </button>
                <ul class="header-nav ms-auto">
                    <li class="nav-item dropdown mx-2">
                        <a class="nav-link dropdown-toggle text-white fw-bold" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img id="selectedFlag" src="{{ asset('vendor/blade-flags/language-id.svg') }}"
                                alt="Default Flag" width="25" height="25">
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li>
                                    <a class="dropdown-item" hreflang="{{ $localeCode }}"
                                        href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}"
                                        onclick="selectOption('{{ $localeCode }}', '{{ LaravelLocalization::getLocalizedURL($localeCode) }}'); return false;">
                                        <img src="{{ asset('vendor/blade-flags/language-' . $localeCode . '.svg') }}"
                                            alt="{{ $properties['native'] }} Flag" width="25" height="25">
                                        {{ $properties['native'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <a href="" class="nav-link">
                        <i class="fas fa-bell"></i>
                    </a>
                </ul>
                <ul class="header-nav ms-3">
                    <li class="nav-item dropdown">
                        <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end pt-0">
                            <a class="dropdown-item"
                                href="{{ route('profile.show', ['locale' => app()->getLocale()]) }}">
                                <svg class="icon me-2">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                                </svg>
                                {{ __('My profile') }}
                            </a>
                            <form method="POST" action="{{ route('logout', ['locale' => app()->getLocale()]) }}">
                                @csrf
                                <a class="dropdown-item" href="{{ route('logout', ['locale' => app()->getLocale()]) }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <svg class="icon me-2">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-account-logout') }}"></use>
                                    </svg>
                                    {{ __('Logout') }}
                                </a>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </header> --}}
        <div class="body flex-grow-1 p-4">
            <div class="container">
                @yield('content')
            </div>
        </div>
    </div>

    {{-- Start Pusher Custom Script --}}
    <script src="{{ asset('js/realtime.js') }}"></script>
    {{-- End Pusher Custom Script --}}

    {{-- Start CoreUI --}}
    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
    {{-- End CoreUI --}}

    {{-- Start Sweetalert Scripts --}}
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    @include('sweetalert::alert')
    {{-- End Sweetalert Scripts --}}

    {{-- <script src="{{ asset('js/popper.min.js') }}"></script> --}}
    <script src="{{ asset('js/toast-alert.js') }}"></script>

    {{-- Flags Script --}}
    {{-- <script>
        function updateSelectedFlagFromURL() {
            var urlSegments = window.location.pathname.split('/');
            var languageCode = urlSegments[1];

            var flagPath = "{{ asset('vendor/blade-flags/language-') }}" + languageCode + ".svg";
            var selectedFlagElement = document.getElementById('selectedFlag');
            selectedFlagElement.src = flagPath;
        }

        window.onload = updateSelectedFlagFromURL;

        function selectOption(languageCode, languageURL) {
            var selectedFlagElement = document.getElementById('selectedFlag');
            selectedFlagElement.src = "{{ asset('vendor/blade-flags/language-' . $localeCode . '.svg') }}";
            window.location.href = languageURL;
        }
    </script> --}}

    {{-- Livewire Script --}}
    @livewireScripts
</body>

</html>
