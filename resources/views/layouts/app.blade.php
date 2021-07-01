<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('frontend.layouts.header')
    </head>

    <body class="home-page is-dropdn-click has-slider">
    {{--Navbar--}}
    @include('frontend.layouts.navbar')
    <div class="page-content">
        @yield('content')
    </div>
    {{--footer--}}
    @include('frontend.layouts.footer')
    </body>
</html>
