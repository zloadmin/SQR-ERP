<div class="card">
    <div class="card-header modal-colored-header bg-danger">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Action Required: Account Setup</h4>
        </div>
    </div>
    <div class="card-body">
        @include('livewire.task.edit-form.blocks.error')
        @if ($editable)
            <form wire:submit.prevent="submitQR" id="submitQRForm">
                <div class="row">
                    <div class="col-md-3">
                        @if($last_attache)
                            <p class="text-center mb-0">
                                {!! $last_attache->getHTMLLink() !!}
                            </p>
                            <br>
                        @endif
{{--                        @include('livewire.task.edit-form.action.blocks.attache-file', ['name' => 'QR\'s'])--}}
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
                <div class="row">
                    <div class="col-md-12">
                        @include('livewire.task.edit-form.action.blocks.comment-alert', ['file' => $not_approve_qr_attache])
                    </div>
                </div>
            </form>
        @endif
    </div> <!-- end card-body -->
</div>
