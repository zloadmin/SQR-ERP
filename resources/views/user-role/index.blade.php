@extends('layouts.dashboard')
@section('title', $title ?? '')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-between mb-2">
                <div class="col-sm-4">
                    {{--<a href="javascript:void(0);" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle mr-2"></i> Add Products</a>--}}
                    <a href="{{ route('settings.user-role.create') }}" class="btn btn-danger mb-2">
                        <i class="mdi mdi-plus-circle mr-2"></i> New Role
                    </a>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-centered mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                {{--                        <th>Email</th>--}}
                                {{--                        <th>Created</th>--}}
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user_roles as $user_role)
                                <tr>
                                    <td>{{ $user_role->id }}</td>
                                    <td>{{ $user_role->name }}</td>
                                    {{--                            <td>{{ $cashier->email }}</td>--}}
                                    {{--                            <td>{{ $cashier->created }}</td>--}}
                                    <td align="right">
                                        <form method="POST" action="{{ route('settings.user-role.delete', $user_role) }}" class="confirm_button" data-confirm-text="Delete role?">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ $user_role->getEditLink() }}" class="action-icon  btn btn-link">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <button type="submit" class="action-icon btn btn-link">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-auto">
                    {{ $user_roles->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
