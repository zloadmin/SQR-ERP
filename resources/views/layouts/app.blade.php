<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SQR ERP') }} - {{ $title ?? '' }}</title>
    <!-- App css -->
    <link href="/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="/css/dashboard.css" rel="stylesheet" type="text/css" />
    {{--    <link href="/css/jquery.datetimepicker.min.css" rel="stylesheet" type="text/css" />--}}
    @stack('styles')
    @livewireStyles
</head>
<body data-layout="topnav">
<div class="wrapper">

    <!-- ========== Left Sidebar Start ========== -->
{{--        @include('client.layouts.dashboard.left-side-menu')--}}
<!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">
            <!-- Topbar Start -->
        @include('layouts.dashboard.topbar')
        <!-- end Topbar -->
            <!-- Start Content-->
            <div class="container-fluid">
                @include('layouts.dashboard.page-title')
                <div class="row">
                    <div class="col-12">
                        @include('layouts.notifications')
                    </div>
                </div>

                                    {{ $slot }}
{{--                @yield('content')--}}
            </div> <!-- container -->
        </div> <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        2019 - {{ date('Y') }} © {{ config('app.name', 'SQR ERP') }} - SQRErp.com
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.bundle.js"></script>
{{--    <script src="/js/metisMenu.js"></script>--}}
{{--    <script src="/js/jquery.slimscroll.js"></script>--}}
{{--    <script src="/js/jquery.toast.js"></script>--}}
{{--    <script src="/js/jquery.mask.min.js"></script>--}}
{{--    <script src="/js/select2.js"></script>--}}
{{--    <script src="/js/moment.js"></script>--}}
{{--    <script src="/js/hyper.js"></script>--}}
<script src="/js/functions.js"></script>
<script src="/js/app.js"></script>
{{--    <script src="/js/jquery.datetimepicker.full.min.js"></script>--}}
{{--    <script>--}}
{{--        $.ajaxSetup({--}}
{{--            headers: {--}}
{{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
{{--    @include('layouts.dashboard.notifications')--}}
@stack('scripts')
@livewireScripts
</body>
</html>
