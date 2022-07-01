<div class="col-4">
    <div class="card">
        <div class="card-body">

            <div
                x-data="{ isUploading: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress"
            >
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title">{{ $title }}</h5>
                    <button type="button" class="btn btn-primary btn-file">
                        <i class="mdi mdi-upload mr-1"></i>
                        Upload
                        <!-- File Input -->
                        <input class="file_input_hidden" type="file" wire:model="{{ $var_name }}" multiple>
                    </button>
                    <!-- Progress Bar -->
                </div>
                <div x-show="isUploading">
                    <div class="progress progress-xl mb-3" max="100" x-bind:value="progress">
                        <div :style="`width: ${progress}%;`" class="progress-bar bg-success"></div>
                    </div>
                </div>
            </div>

            @error($var_name . '.*')
                <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                    {{ $message }}
                </div>
            @enderror
            @isset($exist_var_name)
                @foreach($$exist_var_name as $key => $file)
                    @include('livewire.files-block.file-card')
                @endforeach
            @endisset
            @foreach($$var_name as $key => $file)
                @include('livewire.files-block.file-card')
            @endforeach




        </div>
    </div>

</div>
