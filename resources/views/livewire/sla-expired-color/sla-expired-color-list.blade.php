<div class="card">
    <div class="card-body">
        <div class="row justify-content-between mb-2">
            <div class="col-sm-4">
                <a href="{{ route('settings.sla-expired-color.create') }}" class="btn btn-danger mb-2">
                    <i class="mdi mdi-plus-circle mr-2"></i> New SLA Expired Color
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
                            <th>Stage</th>
                            <th>Color</th>
                            <th>Time</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sla_expired_colors as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->stage->name }}</td>
                                <td>
                                    <span class="badge" style="background: {{ $item->color }}">
                                        {{ $item->color }}
                                    </span>
                                </td>
                                <td>{{ $item->total_time_text }}</td>
                                <td align="right">
                                    <a href="{{ $item->getEditLink() }}" class="action-icon  btn btn-link">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                    @include('livewire.buttons.delete-with-confirm', ['delete_id' => $item->id])
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
                {{ $sla_expired_colors->links() }}
            </div>
        </div>
    </div>
</div>
<livewire:modal.confirm-delete-modal />
