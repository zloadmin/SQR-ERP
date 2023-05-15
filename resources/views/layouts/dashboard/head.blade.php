<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SQR ERP') }} - @yield('title') {{ $title ?? '' }}</title>

    <link rel="manifest" href="/manifest.json" />

    <!-- App css -->
    <link href="/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="/css/dashboard.css?v=2" rel="stylesheet" type="text/css" />
    {{--    <link href="/css/jquery.datetimepicker.min.css" rel="stylesheet" type="text/css" />--}}

    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
{{--    <link rel="manifest" href="/site.webmanifest">--}}

    @stack('styles')
    @livewireStyles
    <script>
        // serviceWorker
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/service-worker.js').then(function(registration) {
                    // Registration was successful
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                }, function(err) {
                    // registration failed :(
                    console.log('ServiceWorker registration failed: ', err);
                });
            });
        }
        // let deferredPrompt;
        window.addEventListener('beforeinstallprompt', function(event) {
            console.log('beforeinstallprompt');
            event.prompt();
        });
    </script>
</head>
