@extends('layouts.guest')

@section('title')
    Access Denied
@endsection

@section('content')
    <style>
        input::placeholder {
            color: white !important;
        }
    </style>

    @php
        $ipAddress = \Request::ip();
        $blockIP = Cache::has('blocked_' . $ipAddress);
    @endphp

    <div class="container d-flex flex-column align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="text-center">
                <h2 class="fw-bold">Access Denied</h2>
                <p>You are not allowed to access this website.</p>
            </div>
            @if (!$blockIP)
                <div class="container-fluid card card-body shadow text-white" style="background-color: #0000CC;">
                    <form action="{{ route('get-access', ['locale' => app()->getLocale()]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="password" class="form-control bg-tabel border-0 text-white" placeholder="•••••••••"
                            id="password" name="password" required>
                        <button type="submit"
                            class="btn btn-sm text-white fw-bold w-100 mt-2 bg-btn-orange">Submit</button>
                    </form>
                </div>
            @else
                <div class="alert alert-danger">
                    <h6 class="m-0">Your IP address has been blocked due to multiple invalid attempts. Try again later
                    </h6>
                </div>
            @endif
        </div>
    </div>
@endsection
