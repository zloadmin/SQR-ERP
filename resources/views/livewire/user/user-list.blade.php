<div class="card">
    <div class="card-body">
        <div class="row justify-content-between mb-2">
            <div class="col-sm-4">
                <a href="{{ route('settings.user-role.create') }}" class="btn btn-danger mb-2">
                    <i class="mdi mdi-plus-circle mr-2"></i> New User
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
                            <th>Email</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->password }}</td>
                                <td>{{ $user->role_name }}</td>
                                <td align="right">
                                    <form method="POST" action="{{ route('settings.user-role.delete', $user) }}"
                                          class="confirm_button" data-confirm-text="Delete role?">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ $user->getEditLink() }}" class="action-icon  btn btn-link">
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
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
