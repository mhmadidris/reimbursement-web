@extends('layouts.auth')

@section('title')
    Reset Password
@endsection

@section('content')
    <div class="d-flex justify-content-center align-items-center align-content-center bg-page-utama" style="height: 100vh;">
        <div class="d-flex flex-column col-5 text-white">
            <h2 class="text-center fw-semibold">Reset Password</h2>
            <h6 class="text-center mb-4">Enter your email to reset your password.</h6>
            <div class="card">
                <div class="card-body p-4">
                    <h6 class="fw-medium">{{ __('Email') }}</h6>
                    <form action="{{ route('password.email', ['locale' => app()->getLocale()]) }}" method="POST">
                        @csrf
                        @if (session('status'))
                            <div role="alert" class="alert alert-success py-2 ">
                                <ul class="py-0 m-0">
                                    <li>{{ session('status') }}</li>
                                </ul>
                            </div>
                        @endif
                        <input class="form-control @error('email') is-invalid @enderror" type="email" id="email"
                            name="email" placeholder="example@mail.com">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="d-flex justify-content-center align-content-center align-items-center">
                            <button class="mt-4 btn btn-block bg-btn-green text-black fw-bold"
                                type="submit">{{ __('Send Password Reset Link') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
