<div class="card">
    <div class="card-header modal-colored-header bg-primary">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Log</h4>
        </div>
    </div>
    <!-- FORM -->
    <div class="card-body pb-0">
        <div class="app-chat">
            @if ($editable)
                <form wire:submit.prevent="createMessage">
                    <div class="mb-2 position-relative">
                        <textarea class="hint2basic form-control" id="summernote" style="resize: none"></textarea>
                        <input type="hidden" id="summernote_hidden" wire:model.defer="text">
                        @error('text')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <button class="action-icon btn chat-icon" wire:loading.attr="disabled"
                                wire:target="createMessage">
                            <div wire:loading.delay wire:target="createMessage">
                                <span class="spinner-border spinner-border-sm me-1" role="status"
                                      aria-hidden="true"></span>
                            </div>
                            <div wire:loading.delay.remove wire:target="createMessage">
                                <span class="mdi mdi-send"></span>
                            </div>
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div> <!-- end card-body -->
    {{--    <div class="row">--}}
    {{--        <div class="col-md-12">--}}
    {{--            --}}
    {{--        </div>--}}
    {{--    </div>--}}
    <!--Chat -->
    <div class="row">
        <div class="col">
            <div class="card-body pt-0 pb-3" data-simplebar="init" style="max-height: 562px">

                <div class="simplebar-wrapper" style="margin: 0px -24px;">
                    <div class="simplebar-height-auto-observer-wrapper">
                        <div class="simplebar-height-auto-observer"></div>
                    </div>
                    <div class="simplebar-mask">
                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                            <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                 aria-label="scrollable content" style="height: auto; overflow: hidden scroll;">
                                <div class="simplebar-content" style="padding: 0px 24px;">
                                    @foreach($log_messages as $log_message)
                                        @include('livewire.task.edit-form.log-message')
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="simplebar-placeholder" style="width: auto; height: 888px;"></div>
                </div>
                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                </div>
                <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                    <div class="simplebar-scrollbar"
                         style="height: 355px; transform: translate3d(0px, 189px, 0px); display: block;"></div>
                </div>
            </div> <!-- end slimscroll-->
        </div> <!-- End col -->
    </div>


</div>


