<!DOCTYPE HTML>
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
    <script>
        window.require = () => {}
    </script>
    @vite(['resources/css/app.css'])
    @stack('css')
    @vite(['resources/js/app.js'])
    <link href="{{ asset('vendor/select2/css/select2.min.css') }}" rel="stylesheet">


</head>

<body data-typography="poppins" data-theme-version="dark" data-layout="vertical" data-nav-headerbg="color_1"
    data-headerbg="color_1" data-sidebar-style="full" data-sibebarbg="color_1" data-sidebar-position="fixed"
    data-header-position="fixed" data-container="wide" direction="ltr" data-primary="color_1"
    data-new-gr-c-s-check-loaded="14.1071.0" data-gr-ext-installed="" cz-shortcut-listen="true">
    @include('layouts.admin.preload')
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        @include('layouts.admin.nav')
        @include('layouts.admin.chat')
        @include('layouts.admin.header')
        @include('layouts.admin.sidebar')
        @yield('content')
        @include('layouts.admin.footer')
    </div>
    <!--**********************************
       Main wrapper end
   ***********************************-->
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    @stack('js')
    <script>
        var path_autocomplete = "{{ route('autocomplete') }}";
        var path_dashboard = "{{ route('admin.home') }}";
    </script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/deznav-init.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="{{ asset('vendor/select2/js/select2.full.min.js') }}"></script>
</body>

</html>
