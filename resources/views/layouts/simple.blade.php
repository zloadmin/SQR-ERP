<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.dashboard.head')
<body >
<div class="wrapper">
    {{ $slot }}
</div>
@include('layouts.dashboard.scripts')
</body>
</html>
