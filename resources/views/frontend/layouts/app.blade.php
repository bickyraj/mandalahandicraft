<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('frontend.layouts.header')
</head>
    <body class="home-page is-dropdn-click">
    {{--Navbar--}}
    @include('frontend.layouts.navbar')
    @include('extras.frontend_message')
    <div class="page-content">
        @yield('content')
    </div>
    {{--footer--}}
    @include('frontend.layouts.footer')
    </body>
</html>
