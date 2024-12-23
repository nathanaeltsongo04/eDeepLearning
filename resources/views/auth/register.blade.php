@extends('layouts.app')

@section('content')
<div class="container">
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 d-flex flex-column align-items-center justify-content-center">
                    <h1 class="card-title text-center pb-3 fs-1 fw-bold text-primary">{{ __('eDeepLearning') }}</h1>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-body p-4">
                            <h2 class="text-center text-primary fw-bold mb-4">Inscription</h2>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label fw-bold">{{ __('Name') }}</label>
                                    <input id="name" type="text" name="name" value="{{ old('name') }}"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="{{ __('Enter your name') }}" required autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-bold">{{ __('Email Address') }}</label>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="{{ __('Enter your email') }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label fw-bold">{{ __('Password') }}</label>
                                    <input id="password" type="password" name="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           placeholder="{{ __('Enter your password') }}" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password-confirm" class="form-label fw-bold">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" name="password_confirmation"
                                           class="form-control"
                                           placeholder="{{ __('Confirm your password') }}" required>
                                </div>

                                <div class="text-center gap-2">
                                    <button type="submit" class="btn btn-primary w-50 fw-bold">
                                        {{ __('S\'inscrire') }}
                                    </button>
                                </div>

                                <div class="text-center mt-3">
                                    <p class="small mb-0">
                                        {{ __('Vous avez déjà un compte ?') }}
                                        <a href="{{ route('login') }}" class="fw-bold text-primary">{{ __('Se connecter') }}</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
