<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.head')
</head>
<body>
    <div class="app">
        @include('includes.header-admin')
        @include('includes.aside-admin')
        <main class="app-main">
            @include('includes.flash-messages')
            @yield('content')
        </main>
    </div>
    @include('modals.notify-alert')
    @include('modals.notify-delete')
</body>
</html>
