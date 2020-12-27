<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.head')
</head>
<body>
    <div class="app">
        <main class="app-main">
            @yield('content')
        </main>
    </div>
</body>
</html>
