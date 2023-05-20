<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta name="keywords" content="" />
        <meta name="author" content="" />
        <meta name="robots" content="" />
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="BlackTop Admin Dashboard" />
        <meta property="og:title" content="BlackTop Admin Dashboard" />
        <meta property="og:description" content="BlackTop Admin Dashboard" />
        <meta property="og:image" content="https://zenix.dexignzone.com/xhtml/social-image.png" />
        <meta name="format-detection" content="telephone=no">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Admin Dashboard') }}</title>
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
        <script>window.require = () => {}</script>
        @vite('resources/css/app.css')
        @stack('css')
    </head>
    <body  class="vh-100">
        @yield('content')
        @vite(['resources/js/app.js'])
        <script src="{{ asset('vendor/global/global.min.js') }}" ></script>
         <script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}" ></script>
         <script src="{{ asset('js/custom.js') }}" ></script>
         <script src="{{ asset('js/deznav-init.js') }}" ></script>        
         
         @stack('js')
    </body>
</html>
