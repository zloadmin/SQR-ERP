@extends('layouts.card')
@section('title', 'Sign In')
@section('content')
    <div class="card-body p-4">
        <div class="text-center">
            <h1 class="text-error">@yield('code')</h1>
            <h4 class="text-uppercase text-danger mt-3">@yield('message')</h4>

            <a class="btn btn-info mt-3" href="{{ route('dashboard') }}"><i class="mdi mdi-reply"></i> Return Home</a>
        </div>
    </div>
@endsection

