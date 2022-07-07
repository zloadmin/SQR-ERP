<div class="card">
    <div class="card-body">
        <div class="row justify-content-between mb-2">
            <div class="col-sm-4">
                <a href="{{ route('settings.webhook.create') }}" class="btn btn-danger mb-2">
                    <i class="mdi mdi-plus-circle mr-2"></i> New WebHook
                </a>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-striped table-centered mb-0">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($web_hooks as $web_hook)
                            <tr>
                                <td>{{ $web_hook->name }}</td>
                                <td align="right">

                                    <a href="{{ $web_hook->getEditLink() }}" class="action-icon  btn btn-link">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                    @include('livewire.buttons.delete-with-confirm', ['delete_id' => $web_hook->id])
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
                {{ $web_hooks->links() }}
            </div>
        </div>
    </div>
</div>

