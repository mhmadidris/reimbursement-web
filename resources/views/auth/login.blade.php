@extends('layouts.auth')

@section('title')
    Login
@endsection

@section('content')
    <div class="container d-flex flex-column align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
            <div class="container-fluid card shadow text-white" style="background-color: #0000CC;">
                <div class="card-body d-flex flex-md-row flex-column justify-content-between align-items-center gap-3">
                    <a href="javascript:void(0);" onclick="history.back();"
                        class="nav-link d-none d-md-flex flex-row align-items-center gap-2" style="font-size: 1rem;">
                        <i class="fas fa-chevron-left"></i>
                        <span class="fw-semibold">Back</span>
                    </a>
                </div>

                <hr class="hr m-0">

                <form method="POST" action="{{ route('login', app()->getLocale()) }}">
                    @csrf
                    <div class="card-body d-flex flex-column gap-2">
                        <div>
                            <label for="nip" class="col-form-label text-md-end fw-bold">{{ __('NIP') }}</label>

                            <div class="">
                                <input id="nip" type="nip" class="form-control @error('nip') is-invalid @enderror"
                                    name="nip" value="{{ old('nip') }}" required placeholder="xxxxxxx"
                                    autocomplete="off" autofocus>

                                @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="password" class="col-form-label text-md-end fw-bold">{{ __('Password') }}</label>

                            <div class="">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    placeholder="••••••••••" required autocomplete="off">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn text-white fw-bold mt-4"
                            style="background-color: #000044;">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
