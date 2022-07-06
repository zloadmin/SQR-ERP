<div class="card">
    <div class="card-body">
        <div class="row justify-content-between mb-2">
            <div class="col-sm-4">
                <a href="{{ route('settings.emailalert.create') }}" class="btn btn-danger mb-2">
                    <i class="mdi mdi-plus-circle mr-2"></i> New Email Alert
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
                        @foreach($email_alerts as $email_alert)
                            <tr>
                                <td>{{ $email_alert->name }}</td>
                                <td align="right">

                                    <a href="{{ $email_alert->getEditLink() }}" class="action-icon  btn btn-link">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                    @include('livewire.buttons.delete-with-confirm', ['delete_id' => $email_alert->id])
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
                {{ $email_alerts->links() }}
            </div>
        </div>
    </div>
</div>

