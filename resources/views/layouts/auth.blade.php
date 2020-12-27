<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.head')
</head>
<body>
    <main class="auth">
        <header id="auth-header" class="auth-header mb-0">
            {{-- <img class="auth-logo" src="{{ secure_asset('images/matome/matomeru_logo_b.png') }}" alt=""> --}}
            @if(request()->is('login') || request()->is('/'))
                <p>{{ __('Don’t have an account yet?') }} <a href="{{ url('/register') }}">{{ __('Create One') }}</a></p>
            @endif
            @if(request()->is('register') || request()->is('/'))
                <p>{{ __('Have an account?') }} <a href="{{ url('/login') }}">{{ __('Login') }}</a></p>
            @endif
        </header>
        @yield('content')
    </main>
</body>
</html>
