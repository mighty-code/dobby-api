<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dobby') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="/favicon.png"/>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>


    @include('includes.google-tag-manager')
</head>
<body class="bg-brand">
<div>

    @include('includes.navbar')

    @yield('content')

</div>


<!-- Scripts -->
</body>
</html>
