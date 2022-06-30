<div class="row mb-2">
    <div class="col-md-6">
        <!--- Company name Field --->
        <div class="form-group">
            <input class="form-control form-control-light @error('company_name') is-invalid @enderror" placeholder="Company name*" type="text" wire:model.defer="company_name">
            @error('company_name')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror
        </div>
        <!--- It is* Field --->
        <div class="form-group">
            <input class="form-control form-control-light @error('it_is') is-invalid @enderror" type="text" wire:model.defer="it_is" placeholder="It is*">
            @error('it_is')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror
        </div>
        <!--- Material* Field --->
        <div class="form-group">
            <input class="form-control form-control-light @error('material') is-invalid @enderror" type="text" wire:model.defer="material" placeholder="Material*">
            @error('material')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror
        </div>
        <!--- Total cards* Field --->
        <div class="form-group">
            <input class="form-control form-control-light @error('total_cards') is-invalid @enderror" type="text" wire:model.defer="total_cards" placeholder="Total cards*">
            @error('total_cards')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror
        </div>
        <!--- Instruction* Field --->
        <div class="form-group">
            <input class="form-control form-control-light @error('instruction') is-invalid @enderror" type="text" wire:model.defer="instruction" placeholder="Instruction*">
            @error('instruction')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror
        </div>
        <!--- Background Field --->
        <div class="form-group">
            <input class="form-control form-control-light @error('background') is-invalid @enderror" type="text" wire:model.defer="background" placeholder="Background">
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
            <textarea class="form-control form-control-light @error('design_comments') is-invalid @enderror" wire:model.defer="design_comments" placeholder="Design comments" rows="6"></textarea>
            @error('design_comments')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror
        </div>
        <!--- Card details Field --->
        <div class="form-group">
            <textarea class="form-control form-control-light @error('card_details') is-invalid @enderror" wire:model.defer="card_details" placeholder="Card details" rows="6"></textarea>
            @error('card_details')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror
        </div>
    </div>
</div>
