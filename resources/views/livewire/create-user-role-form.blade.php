<form wire:submit.prevent="submit">
@csrf
<!--- Role Name Field --->
    <div class="form-group">

        <label for="name">Role Name</label>
        <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror">
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <!--- Create Field --->
    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="submit">
        <div wire:loading.delay wire:target="submit">
            <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
            Loading...
        </div>
        <div wire:loading.delay.remove wire:target="submit">
            Create
        </div>
    </button>
</form>

