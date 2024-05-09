@extends('layouts.auth')

@section('title')
    Register
@endsection

@section('content')
    <style>
        .btn-color {
            border: 1.5px solid white;
            font-weight: bold;
            color: white;
        }

        .btn-color:hover {
            border: 1.5px solid transparent;
            font-weight: bold;
            background-color: white;
            color: black;
        }
    </style>

    <div class="container d-flex flex-column align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
            <div class="container-fluid card shadow text-white" style="background-color: #0000CC;">

                <form method="POST" action="{{ route('register', app()->getLocale()) }}">
                    @csrf
                    <div class="card-body d-flex flex-column gap-2">
                        <div>
                            <label for="name" class="col-form-label fw-bold text-md-end">{{ __('Name') }}</label>

                            <div class="">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" placeholder="John Smith" required autocomplete="off"
                                    autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="email"
                                class="col-form-label text-md-end fw-bold">{{ __('Email Address') }}</label>

                            <div class="">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="john@email.com"
                                    name="email" value="{{ old('email') }}" required autocomplete="off">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="password" class="col-form-label text-md-end fw-bold">{{ __('Password') }}</label>

                            <div>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="off" placeholder="••••••••••">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="password-confirm"
                                class="col-form-label text-md-end fw-bold">{{ __('Confirm Password') }}</label>

                            <div>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="off" placeholder="••••••••••">
                            </div>
                        </div>

                        <button type="submit" class="btn text-white fw-bold mt-2" style="background-color: #000044;">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
