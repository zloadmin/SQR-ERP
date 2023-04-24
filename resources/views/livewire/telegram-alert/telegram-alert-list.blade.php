<div class="card">
    <div class="card-body">
        <div class="row  mb-2">
            <div class="col-sm-3">
                <a href="{{ route('settings.telegram_alert.create') }}" class="btn btn-danger mb-2">
                    <i class="mdi mdi-plus-circle mr-2"></i> New Telegram Alert
                </a>
            </div>
            <div class="col-sm-3">
                <a href="{{ route('settings.telegram_alert.create-inventory') }}" class="btn btn-danger mb-2">
                    <i class="mdi mdi-plus-circle mr-2"></i> New Telegram Inventory Alert
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
                        @foreach($telegram_alerts as $telegram_alert)
                            <tr>
                                <td>{{ $telegram_alert->name }}</td>
                                <td align="right">

                                    <a href="{{ $telegram_alert->getEditLink() }}" class="action-icon  btn btn-link">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                    @include('livewire.buttons.delete-with-confirm', ['delete_id' => $telegram_alert->id])
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
                {{ $telegram_alerts->links() }}
            </div>
        </div>
    </div>
</div>

