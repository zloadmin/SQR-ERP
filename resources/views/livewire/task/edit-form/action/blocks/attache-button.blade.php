<button
    type="button"
    class="btn btn-primary btn-file w-100"
    wire:loading.attr="disabled"
    wire:target="{{ $model_name ?? 'attache'}}"

    x-data="{ isUploading: false, progress: 0 }"
    x-on:livewire-upload-start="isUploading = true"
    x-on:livewire-upload-finish="isUploading = false"
    x-on:livewire-upload-error="isUploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress"
    style="position: relative"
>
    @if (${$model_name ?? 'attache'})
        {{ ${$model_name ?? 'attache'}->getClientOriginalName() }}
    @else
{{--        <div wire:loading.delay wire:target="{{ $model_name ?? 'attache'}}">--}}
{{--            <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>--}}
{{--            Loading...--}}
{{--        </div>--}}
        <div wire:loading.delay.remove wire:target="{{ $model_name ?? 'attache'}}">
            <i class="mdi mdi-upload mr-1"></i>
            Attache {{ $name }}
        </div>
    @endif
<!-- File Input -->
    <input class="file_input_hidden" type="file" wire:model="{{ $model_name ?? 'attache'}}">
    <div x-show="isUploading" style="height: 8px;margin-top: 3px;margin-bottom: 10px;">

        <div class="progress progress-xl mb-3" max="100" x-bind:value="progress">
            <div :style="`width: ${progress}%;`" class="progress-bar bg-success"></div>
        </div>
    </div>
</button>



@error($model_name ?? 'attache')
    <span class="invalid-feedback d-block" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
