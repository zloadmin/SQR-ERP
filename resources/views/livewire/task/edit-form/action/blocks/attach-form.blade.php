<h5 class="mt-0 mb-2 font-16">Submit file</h5>
<button type="button" class="btn btn-primary btn-file w-100 ">
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
<button type="button" class="btn btn-success w-100 mt-3" wire:loading.attr="disabled" wire:target="submitAttache" wire:click="submitAttache">
    <div wire:loading.delay wire:target="submitAttache">
        <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
        Loading...
    </div>
    <div wire:loading.delay.remove wire:target="submitAttache">
        Submit
    </div>
</button>
