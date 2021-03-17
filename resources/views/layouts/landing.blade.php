<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.head-landing')

<script src="https://www.google.com/recaptcha/api.js?render={!! env('RECAPTCHA_SITE_KEY') !!}"></script>
</head>
<body>
    <main class="app app app-site">
        @yield('content')
    </main>
</body>
</html>
