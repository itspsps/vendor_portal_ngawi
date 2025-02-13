<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Vendor Portal - Supplier</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    @include('dashboard.user.new_user.layouts.css')
    @yield('css')

</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="51">


    @yield('content')

    <!-- JavaScript Libraries -->
    @include('dashboard.user.new_user.layouts.js')
    @yield('js')

</body>

</html>