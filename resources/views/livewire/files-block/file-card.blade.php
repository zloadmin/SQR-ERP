<div class="card mb-1 shadow-none border">
    <div class="p-2">
        <div class="row align-items-center">
            <div class="col ps-0">
                <a href="javascript:void(0);" class="text-muted fw-bold">
                    {{ substr($file->getClientOriginalName(), 0, 30) }}
                </a>
                <p class="mb-0">
                    {{ number_format($file->getSize() / 100000, 2)  }} MB
                </p>
            </div>
            <div class="col-auto">
                @isset($file->id)
                    <!-- Button -->
                    <a wire:click.prevent="deleteExistFile('{{$exist_var_name}}', {{ $file->id }})" class="btn btn-link btn-lg text-muted">
                        <i class="dripicons-cross"></i>
                    </a>
                @else
                    <!-- Button -->
                    <a wire:click.prevent="deleteFile('{{$var_name}}', {{ $key }})" class="btn btn-link btn-lg text-muted">
                        <i class="dripicons-cross"></i>
                    </a>
                @endisset
            </div>
        </div>
    </div>
</div>
