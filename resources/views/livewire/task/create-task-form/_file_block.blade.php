<div class="col-md-4">
    <ul class="nav nav-tabs nav-justified nav-bordered mb-3">
        <li class="nav-item">
            <a href="#" class="nav-link">
                <span>{{ $title }}</span>
{{--                <button type="button" class="btn btn-warning"><i class="mdi mdi-wrench"></i> </button>--}}
            </a>
        </li>
    </ul>
    <div
        x-data="{ isUploading: false, progress: 0 }"
        x-on:livewire-upload-start="isUploading = true"
        x-on:livewire-upload-finish="isUploading = false"
        x-on:livewire-upload-error="isUploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress"
    >


        <!-- Progress Bar -->
        <div x-show="isUploading">
            <progress max="100" x-bind:value="progress"></progress>
        </div>
    </div>


    @error($var_name . '.*')
    <span class="invalid-feedback d-block">{{ $message }}</span>
    @enderror
    @foreach($$var_name as $key => $file)

        <div>
            <div class="card mt-1 mb-0 shadow-none border">
                <div class="p-2">
                    <div class="row align-items-center">
{{--                        <div class="col-auto">--}}
{{--                            @if($file->isPreviewable())--}}
{{--                                <img src="{{ $file->temporaryUrl() }}" class="avatar-sm rounded bg-light" alt="">--}}
{{--                            @endif--}}
{{--                        </div>--}}
                        <div class="col-sm-8">
                            <p class="text-muted fw-bold">
                                {{ $file->getClientOriginalName() }}
                            </p>
                        </div>

                        <div class="col-auto">
                            <!-- Button -->
                            <a wire:click.prevent="deleteFile('{{$var_name}}', {{ $key }})" class="btn btn-link btn-lg text-muted" data-dz-remove>
                                <i class="dripicons-cross"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
{{--    <pre>--}}
{{--                    {{ count($$var_name) }}--}}
{{--                </pre>--}}
</div>
