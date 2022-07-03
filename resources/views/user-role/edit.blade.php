@extends('layouts.dashboard')
@section('title', $title ?? '')
@section('content')
    <livewire:edit-user-role :user-role="$user_role"/>

@endsection
