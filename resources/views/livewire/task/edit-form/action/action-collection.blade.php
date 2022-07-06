<div class="card">
    <div class="card-header modal-colored-header bg-danger">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Actions Collection</h4>
        </div>
    </div>
    <div class="card-body">
        @if($editable)
            <form wire:submit.prevent="submitDeliverySlip" id="submitDeliverySlipForm">
                <div class="row">
                    <div class="col-md-3">
                        @include('livewire.task.edit-form.action.blocks.attache-file', ['name' => 'Delivery Slip'])
                    </div>
                    <div class="col-md-3">
                        <!--- card_collected Field --->
                        <div class="form-group">
                            <input class="form-control @error('card_collected') is-invalid @enderror" type="text" placeholder="Card Collected*" wire:model="card_collected">
                            @error('card_collected')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <!--- delivery_reference Field --->
                        <div class="form-group">
                            <input class="form-control @error('delivery_reference') is-invalid @enderror" type="text" placeholder="Delivery Reference*" wire:model="delivery_reference">
                            @error('delivery_reference')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-success w-100" wire:loading.attr="disabled" wire:target="submitDeliverySlip">
                            <div wire:loading.delay wire:target="submitDeliverySlip">
                                <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                                Loading...
                            </div>
                            <div wire:loading.delay.remove wire:target="submitDeliverySlip">
                                Submit
                            </div>
                        </button>
                    </div>
                </div>
            </form>
        @endif
    </div> <!-- end card-body -->
</div>
