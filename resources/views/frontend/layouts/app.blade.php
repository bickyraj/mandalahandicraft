<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>
            @hasSection ('title')
                @yield('title') -
            @endif
            Mandala Handicraft
        </title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        {{-- <link href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@700&family=Roboto:ital,wght@0,100;0,300;0,700;1,200&display=swap" rel="stylesheet"> --}}
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Roboto:ital,wght@0,100;0,300;0,700;1,200&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/smartmenus@1.1.1/dist/css/sm-core-css.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <style>
            [x-cloak] { display:none; }
        </style>
    </head>
    <body x-data="{cartDrawerOpen:false}">
        @include('partials/header')

        <main>
            @yield('content')
        </main>

        @include('partials/footer')
        @include('partials/cart')

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/smartmenus@1.1.1/dist/jquery.smartmenus.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.6.1/dist/gsap.min.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>

        @stack('scripts')
    </body>
</html>
