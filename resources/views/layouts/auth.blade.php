<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.head')
    <script src="https://www.google.com/recaptcha/api.js?render={!! env('RECAPTCHA_SITE_KEY') !!}"></script>
</head>
<body>
    <main class="auth">
        <header id="auth-header" class="auth-header mb-0" style="width:520px;">
            <div class="row">
                <div class="col-md-3">
                    <img class="auth-logo" src="{{ secure_asset('site/images/logo.png') }}" alt="" style="width:100px;">
                </div>
                <div class="col-md-9">
                    <h1 class="text-left" style="line-height:82px;">Diversity Eikaiwa</h1>
                </div>
            </div>
            @if(request()->is('s/login') || request()->is('/'))
                <p>{{ __('Don’t have an account yet?') }} <a href="{{ route('page_register') }}">{{ __('Create One') }}</a></p>
            @endif
            @if(request()->is('s/signup') || request()->is('/'))
                <p>{{ __('Have an account?') }} <a href="{{ route('page_login') }}">{{ __('Login') }}</a></p>
            @endif
        </header>
        @yield('content')
    </main>
</body>
</html>
