<div class="card">
    <div class="card-header modal-colored-header bg-danger">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Actions Account Setup</h4>

        </div>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="submitQR" id="submitQRForm">
            <div class="row">
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary btn-file w-100">
                        <i class="mdi mdi-upload mr-1"></i>
                        @if ($attache)
                            {{ $attache->getClientOriginalName() }}
                        @else
                            Attache QR's
                        @endif
                        <!-- File Input -->
                        <input class="file_input_hidden" type="file" wire:model="attache">
                    </button>
                    @error('attache')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <!--- Username Field --->
                    <div class="form-group">
                        <input class="form-control @error('username') is-invalid @enderror" type="text" wire:model.defer="username" placeholder="Username">
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <!--- Password Field --->
                    <div class="form-group">
                        <input class="form-control  @error('password') is-invalid @enderror" type="text" wire:model.defer="password" placeholder="Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-success w-100" wire:loading.attr="disabled" wire:target="submitQR">
                        <div wire:loading.delay wire:target="submitQR">
                            <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                            Loading...
                        </div>
                        <div wire:loading.delay.remove wire:target="submitQR">
                            Submit
                        </div>
                    </button>
                </div>
            </div>
        </form>
    </div> <!-- end card-body -->
</div>
