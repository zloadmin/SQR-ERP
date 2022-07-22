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

    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
{{--    <link rel="manifest" href="/site.webmanifest">--}}

    @stack('styles')
    @livewireStyles
</head>
