<form wire:submit.prevent="editSQRCard" id="editSQRCardForm">
    <!--- Username Field --->
    <div class="form-group">
        <input class="form-control form-control-light @error('sqr_card_username') is-invalid @enderror" type="text" wire:model="sqr_card_username" placeholder="Username">
        @error('sqr_card_username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <!--- Password Field --->
    <div class="form-group">
        <input class="form-control form-control-light @error('sqr_card_password') is-invalid @enderror" type="text" wire:model="sqr_card_password" placeholder="Password">
        @error('sqr_card_password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</form>
