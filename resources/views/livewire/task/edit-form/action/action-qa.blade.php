<div class="card">
    <div class="card-header modal-colored-header bg-danger">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Action Required: QA</h4>
        </div>
    </div>
    <div class="card-body">
        @include('livewire.task.edit-form.blocks.error')
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Card</h5>
                        @foreach(\App\Models\Task::QA_CARDS as $key =>  $card)
                            <!--- {{ $card }} Field --->
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" wire:model="cards" value="{{ $key }}" id="checkbox_cards_{{ $key }}">
                              <label class="form-check-label" for="checkbox_cards_{{ $key }}">
                                {{ $card }}
                              </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-6">
                        <h5>Order</h5>
                        @foreach(\App\Models\Task::QA_ORDERS as $key =>  $order)
                            <!--- {{ $order }} Field --->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" wire:model="orders" value="{{ $key }}" id="checkbox_orders_{{ $key }}">
                                <label class="form-check-label" for="checkbox_orders_{{ $key }}">
                                    {{ $order }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                @if($editable)
                    @include('livewire.task.edit-form.action.blocks.approve-decline-form', ['approve_button_disable' => !$this->isAllChecked()])
                @endif
            </div>
        </div>
    </div> <!-- end card-body -->
</div>
