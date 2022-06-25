@extends('layouts.dashboard')
@section('title', $title ?? '')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-centered mb-0">
                    <thead>
                    <tr>
                        <th>Manage</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item['title'] }}</td>
                            <td>
                                <a href="{{ $item['link'] }}" class="action-icon  btn btn-link">
                                    <i class="mdi mdi-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
