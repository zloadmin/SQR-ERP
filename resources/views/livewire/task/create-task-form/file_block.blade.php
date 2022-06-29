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

{{--                <div class="progress" x-show="isUploading">--}}

{{--                    --}}
{{--                    <progress max="100" aria-valuemin="0" aria-valuemax="100" x-bind:aria-valuenow="progress" class="progress-bar progress-bar-striped progress-bar-animated"></progress>--}}
{{--                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"  x-bind:aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                </div>--}}
            </div>

            @error($var_name . '.*')
            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                    {{ $message }}
                </div>
            @enderror

            @foreach($$var_name as $key => $file)


                <div class="card mb-1 shadow-none border">
                    <div class="p-2">
                        <div class="row align-items-center">
                            <div class="col ps-0">
                                <a href="javascript:void(0);" class="text-muted fw-bold">
                                    {{ substr($file->getClientOriginalName(), 0, 30) }}
                                </a>
                                <p class="mb-0">{{ number_format($file->getSize() / 100000, 2)  }} MB</p>
                            </div>
                            <div class="col-auto">
                                <!-- Button -->
                                <a wire:click.prevent="deleteFile('{{$var_name}}', {{ $key }})" class="btn btn-link btn-lg text-muted">
                                    <i class="dripicons-cross"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach




        </div>
    </div>

</div>
