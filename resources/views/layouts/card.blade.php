<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="/admin/images/favicon.ico">
    <title>{{ config('app.name', 'SQRLoyalty') }} - @yield('title')</title>

    <!-- App css -->
    <link href="/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="/css/dashboard.css" rel="stylesheet" type="text/css" />
</head>
<body class="authentication-bg">
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card">
                        <!-- Logo -->
                        <div class="card-header pt-4 pb-4 text-center bg-primary">
                            <a href="index.html">
                                <span><img src="/images/logo.png" alt="" height="18"></span>
                            </a>
                        </div>
                        @yield('content')
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            @stack('sub_text')
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->
    @include('layouts.card.footer')
</body>
</html>
