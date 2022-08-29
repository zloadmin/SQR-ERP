<button type="button" class="btn btn-primary btn-file w-100" wire:loading.attr="disabled" wire:target="attache">
    @if ($attache)
        {{ $attache->getClientOriginalName() }}
    @else
        <div wire:loading.delay wire:target="attache">
            <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
            Loading...
        </div>
        <div wire:loading.delay.remove wire:target="attache">
            <i class="mdi mdi-upload mr-1"></i>
            Attache {{ $name }}
        </div>
    @endif
<!-- File Input -->
    <input class="file_input_hidden" type="file" wire:model="attache">
</button>
@error('attache')
    <span class="invalid-feedback d-block" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
