<div class="card">
    <div class="card-header modal-colored-header bg-danger">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Actions Design</h4>

        </div>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="submitDesign" id="submitDesignForm">
            <div class="row">
                <div class="col-md-4">
                    @include('livewire.task.edit-form.action.files')
                </div>
                <div class="col-md-4">
                    @if ($not_approve_design_attache && $not_approve_design_attache->approved_comment)
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Comment!</h4>
                            <p>{{ $not_approve_design_attache->approved_comment }}</p>
                        </div>
                    @endif
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-primary btn-file w-100 mb-3">
                        <i class="mdi mdi-upload mr-1"></i>
                        @if ($attache)
                            {{ $attache->getClientOriginalName() }}
                        @else
                            Attache Design
                    @endif
                    <!-- File Input -->
                        <input class="file_input_hidden" type="file" wire:model="attache">
                    </button>
                    @error('attache')
                    <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <button class="btn btn-success w-100" wire:loading.attr="disabled" wire:target="submitDesign">
                        <div wire:loading.delay wire:target="submitDesign">
                            <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                            Loading...
                        </div>
                        <div wire:loading.delay.remove wire:target="submitDesign">
                            Submit
                        </div>
                    </button>
                </div>

            </div>
        </form>
    </div> <!-- end card-body -->
</div>
