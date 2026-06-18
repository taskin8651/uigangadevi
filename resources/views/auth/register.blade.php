@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="auth-card">
    <div class="auth-card-head">
        <span><i class="bi bi-person-plus-fill"></i> Account Registration</span>
        <h2>{{ trans('global.register') }}</h2>
        <p>Create an account for protected college administration access.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf

        <div class="auth-field">
            <label for="name">{{ trans('global.user_name') }}</label>
            <div class="auth-input-wrap">
                <i class="bi bi-person-fill"></i>
                <input id="name"
                       type="text"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       autofocus
                       class="auth-input {{ $errors->has('name') ? 'error' : '' }}">
            </div>
            @if($errors->has('name'))
                <p class="auth-error">{{ $errors->first('name') }}</p>
            @endif
        </div>

        <div class="auth-field">
            <label for="email">{{ trans('global.login_email') }}</label>
            <div class="auth-input-wrap">
                <i class="bi bi-envelope-fill"></i>
                <input id="email"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
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

        <div class="auth-field">
            <label for="password_confirmation">{{ trans('global.login_password_confirmation') }}</label>
            <div class="auth-input-wrap">
                <i class="bi bi-shield-lock-fill"></i>
                <input id="password_confirmation"
                       type="password"
                       name="password_confirmation"
                       required
                       class="auth-input">
            </div>
        </div>

        <button type="submit" class="auth-button">
            {{ trans('global.register') }}
        </button>

        <div class="auth-bottom">
            Already have an account?
            <a href="{{ route('login') }}" class="auth-link">Login</a>
        </div>

        <div class="auth-bottom">
            <a href="{{ route('frontend.index') }}" class="auth-back-home">
                <i class="bi bi-arrow-left"></i>
                Back to website
            </a>
        </div>
    </form>
</div>
@endsection
