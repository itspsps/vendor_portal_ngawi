<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <title>@yield('title')</title>

  <!-- Favicons -->
  <link href="{{asset('logo-login-sps.png')}}" rel="icon">

  <!-- Fonts -->
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
  <script>
    WebFont.load({
      google: {
        "families": ["Poppins:300,400,500,600,700", "Asap+Condensed:500"]
      },
      active: function() {
        sessionStorage.fonts = true;
      }
    });
  </script>

  @include('auth.layout.css')
  @yield('css')
</head>

<body style="">

  @yield('content')

</body>
@include('auth.layout.js') @yield('js')

</html>