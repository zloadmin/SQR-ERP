<div class="card">
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-12">
                <form wire:submit.prevent="submit">
                    <!--- Name Field --->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" wire:model.defer="name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!--- Witch Inventory Field --->
                    <div class="form-group">
                        <label for="stage_id">Witch Inventory</label>
                        <select class="form-control @error('inventory_id') is-invalid @enderror" wire:model.defer="inventory_id">
                            <option value=""></option>
                            @foreach(\App\Models\Inventory::all() as $inventory)
                                <option value="{{ $inventory->id }}">{{ $inventory->name }}</option>
                            @endforeach
                        </select>
                        @error('inventory_id')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--- available_less_then Field --->
                    <div class="form-group">
                        <label for="available_less_then">Available less then</label>
                        <input class="form-control @error('available_less_then') is-invalid @enderror" type="number" minlength="1" wire:model="available_less_then">
                        @error('available_less_then')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--- Text Field --->
                    <div class="form-group">
                        <label for="text">Text</label>
                        <textarea class="form-control @error('text') is-invalid @enderror" wire:model="text" rows="10"></textarea>
                        @error('text')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show" role="alert">
                        You can use variables: <br>
                        @foreach(\App\Models\TelegramAlert::VARIABLES_INVENTORY as $variable)
                            <strong>
                                @php
                                    echo '{{' . $variable . '}}';
                                @endphp
                            </strong>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Recipients</label>
                        </div>
                    </div>
                    @error('recipient_ids')
                        <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                    @foreach(\App\Models\User::getWithTelegram() as $user)
                        <!--- User {{ $user->id }} Field --->
                        <div class="row">
                            <div class="col-md-12">
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="{{ $user->id }}" wire:model.defer="recipient_ids"> {{ $user->name }} ({{ '@' }}{{ $user->telegram_username }})
                                </label>
                            </div>
                        </div>
                    @endforeach

                    <!--- Save Field --->
                    <button type="submit" class="btn btn-primary mt-3" wire:loading.attr="disabled" wire:target="submit">
                        <div wire:loading.delay wire:target="submit">
                            <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                            Loading...
                        </div>
                        <div wire:loading.delay.remove wire:target="submit">
                            Save
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </div> <!-- end card-body-->
</div> <!-- end card-->


