<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SQR ERP') }} - @yield('title')</title>
    <!-- App css -->
    <link href="/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="/css/dashboard.css" rel="stylesheet" type="text/css" />
    {{--    <link href="/css/jquery.datetimepicker.min.css" rel="stylesheet" type="text/css" />--}}
    @stack('styles')
    @livewireStyles
</head>
