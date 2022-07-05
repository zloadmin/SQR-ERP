<button type="button" class="btn btn-primary btn-file w-100">
    <i class="mdi mdi-upload mr-1"></i>
    @if ($attache)
        {{ $attache->getClientOriginalName() }}
    @else
        Attache {{ $name }}
    @endif
<!-- File Input -->
    <input class="file_input_hidden" type="file" wire:model="attache">
</button>
@error('attache')
    <span class="invalid-feedback d-block" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
