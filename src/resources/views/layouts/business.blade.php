<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/favicon.ico">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Style -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="/css/fontawesome.min.css">

    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDRWbgswuO3sl8vFrowfR2fJ58UEhx0Ci4&callback=initMap"
            defer></script>
    @yield('styles')
</head>
<body class="d-flex flex-column">

@include('constructor._menu')

@yield('content')

@include('constructor._footer')

<script src="{{ mix('/js/app.js') }}"></script>
@stack('scripts')
<script src="/js/pages/map-google.js"></script>

</body>
</html>
