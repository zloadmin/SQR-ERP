<div class="row mb-2">
    <div class="col-md-6">
        <!--- Contact name Field --->
        <div class="form-group">
            <input class="form-control form-control-light @error('contact_name') is-invalid @enderror" type="text" wire:model.defer="contact_name" placeholder="Contact name">
            @error('contact_name')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror
        </div>
        <!--- Contact number Field --->
        <div class="form-group">
            <input class="form-control form-control-light @error('contact_number') is-invalid @enderror" type="text" wire:model.defer="contact_number" placeholder="Contact number">
            @error('contact_number')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror
        </div>
        <!--- WhatsApp Field --->
        <div class="form-group">
            <input class="form-control form-control-light @error('whatsapp') is-invalid @enderror" type="text" wire:model.defer="whatsapp" placeholder="WhatsApp">
            @error('whatsapp')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror
        </div>
        <!--- Contact_email Field --->
        <div class="form-group">
            <input class="form-control form-control-light @error('contact_email') is-invalid @enderror" type="email" wire:model.defer="contact_email" placeholder="Contact_email">
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
            <input class="form-control form-control-light @error('delivery_method') is-invalid @enderror" type="text" wire:model.defer="delivery_method" placeholder="Delivery method">
            @error('delivery_method')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror
        </div>
        <!--- Emirate Field --->
        <div class="form-group">
            <input class="form-control form-control-light @error('emirate') is-invalid @enderror" type="text" wire:model.defer="emirate" placeholder="Emirate">
            @error('emirate')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror
        </div>
        <!--- Address Field --->
        <div class="form-group">
            <textarea class="form-control form-control-light @error('address') is-invalid @enderror" wire:model.defer="address" placeholder="Address" rows="3" style="height: 91px"></textarea>
            @error('address')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror
        </div>
    </div>
</div>
