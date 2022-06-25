@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('content')
    <div class="container">
        {{ var_export(auth()->user()) }}
    </div>
@endsection
