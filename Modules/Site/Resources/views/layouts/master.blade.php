<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" type="image/png" href="{{ asset('static/site/favicon.png') }}"/>

    <title>{{ config('app.name', 'GarjooNepal') }}</title>

    @yield('meta')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,900|Cabin:400,700|Droid+Serif:400,700|Playball" rel="stylesheet">
    <!-- End of Fonts -->

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/hs-menu.min.css') }}" rel="stylesheet">

    @yield('css')
    @stack('styles')
    <!-- End of Styles -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.1.1/dist/select2-bootstrap-5-theme.min.css" />

</head>
<body class="bg-app-bg">
    <div id="app">
        @include('sweetalert::alert')
        <!-- Header -->
        @include('site::partials.header')
        <!-- End of Header -->

        <!-- Content -->
        <div id="app-content">
            @yield('content')
        </div>
        <!-- End of Content -->

        <!-- Footer -->
        @include('site::partials.footer')
        <!-- End of Footer -->
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>--}}
    <script src="{{ asset('js/validation/switchAccount.js') }}"></script>
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.3/js/swiper.min.js"></script>--}}
{{--    <script>--}}
{{--        var swiper = new Swiper('.swiper-container', {--}}
{{--            navigation: {--}}
{{--                nextEl: '.swiper-button-next',--}}
{{--                prevEl: '.swiper-button-prev',--}}
{{--            },--}}
{{--        });--}}
{{--    </script>--}}
    @yield('js')
    @stack('scripts')
    <!-- End of Scripts -->

</body>
</html>
