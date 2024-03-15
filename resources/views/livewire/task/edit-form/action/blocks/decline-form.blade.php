<div class="row mb-2">
    <div class="col-md-12">
        <h5 class="mt-0 mb-2 font-16">Comment</h5>
        <!--- Comment Field --->
        <div class="form-group">
            <textarea class="form-control @error('comment') is-invalid @enderror" wire:model="comment"></textarea>
            @error('comment')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
            @enderror
        </div>
        <div class="row">
            <div class="col-md-6">
                <!--- Setup Field --->
                <div class="form-check form-check-inline">
                  <input class="form-check-input @error('next_stage') is-invalid @enderror" type="radio" value="1" wire:model="next_stage" id="radio_next_stage_1">
                  <label class="form-check-label" for="radio_next_stage_1">
                    Setup
                  </label>
                </div>
                <!--- Support Field --->
                <div class="form-check form-check-inline">
                  <input class="form-check-input @error('next_stage') is-invalid @enderror" type="radio" value="11" wire:model="next_stage" id="radio_next_stage_11">
                  <label class="form-check-label" for="radio_next_stage_11">
                    Support
                  </label>
                </div>

            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-danger float-right" wire:loading.attr="disabled" wire:target="decline" wire:click="decline">
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
