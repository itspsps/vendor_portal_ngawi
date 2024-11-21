<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <title>@yield('title')</title>

    <!-- Favicons -->
    <link href="{{asset('img/favicon.png')}}" rel="icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

    @include('auth.layout.css')
    @yield('css')
</head>
<body style="">

  @yield('content')

</body>
@include('auth.layout.js') @yield('js')
</html>
