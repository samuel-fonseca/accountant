<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Accountant') }}</title>
    <script></script>
    <meta name="description" content="{{ config('app.description') }}" />
    {{-- APP_NAME="Accountant: Self-Employed"
APP_SHORT_NAME="Accountant"
APP_DESCRIPTION="🧮 Accountant is a web app built with Laravel and VueJS which aims to make accounting for self-employed people to track expenses and income." --}}

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('head.scripts')
</head>
<body>
    <div id="app">
        @yield('content')
    </div>
</body>
</html>
