<div class="card">
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-12">
                <form wire:submit.prevent="submit">
                    <!--- Name Field --->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" wire:model.defer="name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--- Save Field --->
                    <button type="submit" class="btn btn-primary mt-3" wire:loading.attr="disabled" wire:target="submit">
                        <div wire:loading.delay wire:target="submit">
                            <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                            Loading...
                        </div>
                        <div wire:loading.delay.remove wire:target="submit">
                            Save
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </div> <!-- end card-body-->
</div> <!-- end card-->


