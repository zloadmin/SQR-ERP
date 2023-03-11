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
                        @include('livewire.task.edit-form.action.blocks.attache-file', ['name' => 'QR\'s'])
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
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <!--- Design Field --->
                                <div class="form-check  form-check-inline" s>
                                  <input class="form-check-input @error('next_stage') is-invalid @enderror" type="radio" wire:model="next_stage" id="radio_next_stage_design" value="2">
                                  <label class="form-check-label" for="radio_next_stage_design">
                                    Design
                                  </label>
                                </div>
                                <!--- Content Field --->
                                <div class="form-check  form-check-inline">
                                  <input class="form-check-input @error('next_stage') is-invalid @enderror" type="radio" wire:model="next_stage" id="radio_next_stage_content" value="4">
                                  <label class="form-check-label" for="radio_next_stage_content">
                                    Content
                                  </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                @error('next_stage')
                                    <span class="invalid-feedback d-block">The field is required.</span>
                                @enderror
                            </div>
                        </div>
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
        @endif
    </div> <!-- end card-body -->
</div>
