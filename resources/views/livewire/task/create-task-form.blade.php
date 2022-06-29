<div style="padding: 100px">
    <form wire:submit.prevent="createTask">
        <div class="row mb-2">
            <div class="col-md-6">
                <!--- Company name Field --->
                <div class="form-group">
                    <input class="form-control form-control-light @error('company_name') is-invalid @enderror" placeholder="Company name*" type="text" wire:model="company_name">
                    @error('company_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!--- It is* Field --->
                <div class="form-group">
                    <input class="form-control form-control-light @error('it_is') is-invalid @enderror" type="text" wire:model="it_is" placeholder="It is*">
                    @error('it_is')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!--- Material* Field --->
                <div class="form-group">
                    <input class="form-control form-control-light @error('material') is-invalid @enderror" type="text" wire:model="material" placeholder="Material*">
                    @error('material')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!--- Total cards* Field --->
                <div class="form-group">
                    <input class="form-control form-control-light @error('total_cards') is-invalid @enderror" type="text" wire:model="total_cards" placeholder="Total cards*">
                    @error('total_cards')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!--- Instruction* Field --->
                <div class="form-group">
                    <input class="form-control form-control-light @error('instruction') is-invalid @enderror" type="text" wire:model="instruction" placeholder="Instruction*">
                    @error('instruction')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!--- Background Field --->
                <div class="form-group">
                    <input class="form-control form-control-light @error('background') is-invalid @enderror" type="text" wire:model="background" placeholder="Background">
                    @error('background')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <!--- Design comments Field --->
                <div class="form-group">
                    <textarea class="form-control form-control-light @error('design_comments') is-invalid @enderror" wire:model="design_comments" placeholder="Design comments" rows="6"></textarea>
                    @error('design_comments')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!--- Card details Field --->
                <div class="form-group">
                    <textarea class="form-control form-control-light @error('card_details') is-invalid @enderror" wire:model="card_details" placeholder="Card details" rows="6"></textarea>
                    @error('card_details')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <!--- Contact name Field --->
                <div class="form-group">
                    <input class="form-control form-control-light @error('contact_name') is-invalid @enderror" type="text" wire:model="contact_name" placeholder="Contact name">
                    @error('contact_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!--- Contact number Field --->
                <div class="form-group">
                    <input class="form-control form-control-light @error('contact_number') is-invalid @enderror" type="text" wire:model="contact_number" placeholder="Contact number">
                    @error('contact_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!--- WhatsApp Field --->
                <div class="form-group">
                    <input class="form-control form-control-light @error('whatsapp') is-invalid @enderror" type="text" wire:model="whatsapp" placeholder="WhatsApp">
                    @error('whatsapp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!--- Contact_email Field --->
                <div class="form-group">
                    <input class="form-control form-control-light @error('contact_email') is-invalid @enderror" type="email" wire:model="contact_email" placeholder="Contact_email">
                    @error('contact_email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <!--- Delivery method Field --->
                <div class="form-group">
                    <input class="form-control form-control-light @error('delivery_method') is-invalid @enderror" type="text" wire:model="delivery_method" placeholder="Delivery method">
                    @error('delivery_method')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!--- Emirate Field --->
                <div class="form-group">
                    <input class="form-control form-control-light @error('emirate') is-invalid @enderror" type="text" wire:model="emirate" placeholder="Emirate">
                    @error('emirate')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!--- Address Field --->
                <div class="form-group">
                    <textarea class="form-control form-control-light @error('address') is-invalid @enderror" wire:model="address" placeholder="Address" rows="3" style="height: 91px"></textarea>
                    @error('address')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mb-4">
            @include('livewire.task.create-task-form.file_block', ['var_name' => 'design_attachments', 'title' => 'Design Attachments'])
            @include('livewire.task.create-task-form.file_block', ['var_name' => 'card_details_attachments', 'title' => 'Card details attachments'])
            @include('livewire.task.create-task-form.file_block', ['var_name' => 'qr_attachments', 'title' => 'QR Attachments'])
{{--            <div class="col-md-3">--}}
{{--                <ul class="nav nav-tabs nav-justified nav-bordered mb-3">--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="#" class="nav-link">--}}
{{--                            <i class="mdi mdi-home-variant d-md-none d-block"></i>--}}
{{--                            <span class="d-none d-md-block">Design Attachments</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="#" class="nav-link">--}}
{{--                            <i class="mdi mdi-home-variant d-md-none d-block"></i>--}}
{{--                            <span class="d-none d-md-block">Card Details Attachments</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="#" class="nav-link">--}}
{{--                            <i class="mdi mdi-home-variant d-md-none d-block"></i>--}}
{{--                            <span class="d-none d-md-block">QR Attachments</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
        </div>
        <div class="row">
            <div class="col-12">
                <!--- Create Field --->
                <button class="btn btn-primary" wire:loading.attr="disabled" wire:target="createTask">
                    <div wire:loading.delay wire:target="createTask">
                        <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                        Loading...
                    </div>
                    <div wire:loading.delay.remove wire:target="createTask">
                        Create
                    </div>
                </button>
            </div>
        </div>
    </form>
</div>
