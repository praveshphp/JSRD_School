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
    {{-- <meta property="og:image" content="https://zenix.dexignzone.com/xhtml/social-image.png" /> --}}
    <meta name="format-detection" content="telephone=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'School') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <script>
        window.require = () => {}
    </script>
    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />
    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Poppins:400,700|Roboto:400,700&display=swap"
        rel="stylesheet" />
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/bootstrap.css') }}" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('front/css/style.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('front/css/responsive.css') }}" rel="stylesheet" />

    @stack('css')


</head>

<body  @if (Route::currentRouteName() != 'front.home') class="sub_page " @endif>
    @include('layouts.admin.preload')
    @include('layouts.front.nav')

    @yield('content')
    @include('layouts.front.footer')

    <script type="text/javascript" src="{{ asset('front/js/jquery-3.4.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/js/bootstrap.js') }}"></script>
  
    
  
    <script>
      function openNav() {
        document.getElementById("myNav").style.width = "100%";
      }
  
      function closeNav() {
        document.getElementById("myNav").style.width = "0%";
      }
    </script>

    @stack('js')
    
</body>

</html>
