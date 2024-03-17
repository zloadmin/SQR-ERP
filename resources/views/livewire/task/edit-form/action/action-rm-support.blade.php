<div class="card">
    <div class="card-header modal-colored-header bg-danger">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Action Required: RM Support</h4>
        </div>
    </div>
    <div class="card-body">
        @include('livewire.task.edit-form.blocks.error')
        @if ($editable)
            <form wire:submit.prevent="submitQR" id="submitQRForm">
                <div class="row">
                    <div class="col-md-9">
                        @include('livewire.task.edit-form.action.blocks.comment-alert', ['file' => $not_approve_qr_attache])
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-success w-100" wire:loading.attr="disabled" wire:target="submitQR">
                            <div wire:loading.delay wire:target="submitQR">
                                <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                                Loading...
                            </div>
                            <div wire:loading.delay.remove wire:target="submitQR">
                                Submit
                            </div>
                        </button>
                    </div>
                </div>
            </form>
        @endif
    </div> <!-- end card-body -->
</div>
