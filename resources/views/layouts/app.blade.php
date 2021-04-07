<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.head')
</head>
<body>
    <div class="app">
        @include('includes.header')
        @include('includes.aside')
        <main class="app-main">
            @include('includes.flash-messages')
            @yield('content')
        </main>
    </div>
    @include('modals.default')
    @include('modals.notify-alert')
    @include('modals.notify-delete')
    @include('modals.notify-delete-ajax')
    @include('modals.notify-plan-upgrade')
</body>
</html>
