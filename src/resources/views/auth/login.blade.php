@extends('layouts.blank')

@section('title', __('headers.login'))

@section('content')
    <form method="POST" action="{{ route('login') }}" class="form-center">
        @csrf

        <a href="/">
            <img class="mb-4 border rounded py-3" src="/images/icon.svg" alt="" width="72" height="72">
        </a>

        <div class="form-group text-left">
            <label for="email">{{ __('forms.auth.email') }}</label>

            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                   value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group text-left">
            <label for="password">{{ __('forms.auth.password') }}</label>

            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group text-left">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember"
                       id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('forms.auth.login.remember_me') }}
                </label>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                {{ __('forms.auth.login.login') }}
            </button>

            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('forms.auth.login.forgot_your_password') }}
                </a>
            @endif
        </div>
    </form>
@endsection
