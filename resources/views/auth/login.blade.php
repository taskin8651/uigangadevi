@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="auth-card">
    <div class="auth-card-head">
        <span><i class="bi bi-person-lock"></i> Admin Login</span>
        <h2>{{ trans('global.login') }}</h2>
        <p>Enter your credentials to continue to the admin dashboard.</p>
    </div>

    @if(session('message'))
        <div class="auth-alert">{{ session('message') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        <div class="auth-field">
            <label for="email">{{ trans('global.login_email') }}</label>
            <div class="auth-input-wrap">
                <i class="bi bi-envelope-fill"></i>
                <input id="email"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autofocus
                       class="auth-input {{ $errors->has('email') ? 'error' : '' }}">
            </div>
            @if($errors->has('email'))
                <p class="auth-error">{{ $errors->first('email') }}</p>
            @endif
        </div>

        <div class="auth-field">
            <label for="password">{{ trans('global.login_password') }}</label>
            <div class="auth-input-wrap">
                <i class="bi bi-key-fill"></i>
                <input id="password"
                       type="password"
                       name="password"
                       required
                       class="auth-input {{ $errors->has('password') ? 'error' : '' }}">
            </div>
            @if($errors->has('password'))
                <p class="auth-error">{{ $errors->first('password') }}</p>
            @endif
        </div>

        <div class="auth-row">
            <label class="auth-check">
                <input type="checkbox" name="remember">
                {{ trans('global.remember_me') }}
            </label>

            @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="auth-link">
                    {{ trans('global.forgot_password') }}
                </a>
            @endif
        </div>

        <button type="submit" class="auth-button">
            {{ trans('global.login') }}
        </button>

        @if(Route::has('register'))
            <div class="auth-bottom">
                Need an account?
                <a href="{{ route('register') }}" class="auth-link">{{ trans('global.register') }}</a>
            </div>
        @endif

        <div class="auth-bottom">
            <a href="{{ route('frontend.index') }}" class="auth-back-home">
                <i class="bi bi-arrow-left"></i>
                Back to website
            </a>
        </div>
    </form>
</div>
@endsection
