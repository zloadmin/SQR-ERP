<div class="card">
    <div class="card-header modal-colored-header bg-danger">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Actions Design Approval</h4>
        </div>
    </div>
    <div class="card-body">
{{--        <form id="approve">--}}
            <div class="row">
                <div class="col-md-4">
                    @include('livewire.task.edit-form.action.files')
                </div>

                <div class="col-md-8">
                    <!--- Comment Field --->
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea class="form-control @error('comment') is-invalid @enderror" wire:model="comment"></textarea>
                        @error('comment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">

                            <button type="button" class="btn btn-success w-100" wire:loading.attr="disabled" wire:target="approve" wire:click="approve">
                                <div wire:loading.delay wire:target="approve">
                                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                                    Loading...
                                </div>
                                <div wire:loading.delay.remove wire:target="approve">
                                    Approve
                                </div>
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-danger w-100" wire:loading.attr="disabled" wire:target="decline" wire:click="decline">
                                <div wire:loading.delay wire:target="decline">
                                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                                    Loading...
                                </div>
                                <div wire:loading.delay.remove wire:target="decline">
                                    Decline
                                </div>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
{{--        </form>--}}
    </div> <!-- end card-body -->
</div>
