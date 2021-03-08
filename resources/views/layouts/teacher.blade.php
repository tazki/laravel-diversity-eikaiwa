<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.head')
</head>
<body>
    <div class="app">
        @include('includes.header-teacher')
        @include('includes.aside-teacher')
        <main class="app-main">
            @include('includes.flash-messages')
            @yield('content')
        </main>
    </div>
    @include('modals.default')
    @include('modals.notify-alert')
    @include('modals.notify-delete')
		@include('modals.notify-delete-ajax')
</body>
</html>
