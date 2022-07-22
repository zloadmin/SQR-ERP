<div class="card">
    <div class="card-header modal-colored-header bg-danger">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Action Required: Done</h4>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                @include('livewire.task.edit-form.action.blocks.files')
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h5 class="mt-0 mb-2 font-16">Statistics</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Start Date
                        <span class="">{{ $start_date->format('d.m.Y') }}</span>
                    </li>
                    @if($end_date)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                End Date
                                <span class="">{{ $end_date->format('d.m.Y') }}</span>
                        </li>
                    @endif
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        NET Date
                        <span class="">{{ $start_date->diffInDays($end_date) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Delivered
                        <span class="">{{ $card_collected }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Reference
                        <span class="">{{ $delivery_reference }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div> <!-- end card-body -->
</div>
