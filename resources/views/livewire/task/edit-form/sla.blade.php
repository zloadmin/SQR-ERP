<div class="card">
    <div class="card-header modal-colored-header bg-primary">
        <div class="d-flex justify-content-between align-items-center">
            <h4>SLA</h4>
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-bordered table-centered mb-0 border-0" style="    margin-top: -1px;">
            <tbody>
            <tr>
                <td style="width: 30%">
                    <p class="mb-0">Time left</p>
                </td>
                <td>
                    <p class="mb-0" wire:poll.60s>{{ $time_left }}</p>

                </td>
            </tr>
            <tr>
                <td>
                    <p class="mb-0">Totla time</p>
                </td>
                <td>
                    <p class="mb-0" wire:poll.60s>{{ $total_time }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="mb-0">Revisions</p>
                </td>
                <td>
                    <p class="mb-0" wire:poll.60s>{{ $revisions }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="mb-0">Created</p>
                </td>
                <td>
                    <p class="mb-0" wire:poll.60s>{{ $start_stage }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="mb-0">Alert</p>
                </td>
                <td>
                    <p class="mb-0 {{ $late ? 'text-danger' : 'text-success' }}" wire:poll.60s>
                        @if($late)
                            Late
                        @else
                            Not late
                        @endif
                    </p>
                </td>
            </tr>


            </tbody>
        </table>
    </div> <!-- end card-body -->
</div>
