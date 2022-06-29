<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.dashboard.head')
<body data-layout="topnav">
<div class="wrapper">
    <div class="content-page">
        <div class="content">
            @include('layouts.dashboard.topbar')
            <div class="container-fluid">
                @include('layouts.dashboard.page-title')
                @include('layouts.notifications')
                @yield('content')
            </div> <!-- container -->
        </div> <!-- content -->
        @include('layouts.dashboard.footer')
    </div>
</div>
@include('layouts.dashboard.scripts')
</body>
</html>
