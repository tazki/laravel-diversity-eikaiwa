<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.head')
</head>
<body>
    <main class="app app app-site">
        @yield('content')
    </main>
</body>
</html>
