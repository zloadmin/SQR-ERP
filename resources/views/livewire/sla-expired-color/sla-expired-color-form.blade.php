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

                    <!--- Stage Field --->
                    <div class="form-group">
                        <label for="stage">Stage</label>
                        <select class="form-control @error('stage_id') is-invalid @enderror" wire:model.defer="stage_id">
                            <option value=""></option>
                            @foreach(\App\Models\Stage::all() as $stage)
                                <option value="{{ $stage['id'] }}">{{ $stage['name'] }}</option>
                            @endforeach
                        </select>
                        @error('stage_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <!--- Time minutes Field --->
                            <div class="form-group">
                                <label for="time_minutes">Time minutes</label>
                                <input class="form-control @error('time_minutes') is-invalid @enderror" type="text" wire:model="time_minutes">
                                @error('time_minutes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!--- Time hours Field --->
                            <div class="form-group">
                                <label for="time_hours">Time hours</label>
                                <input class="form-control @error('time_hours') is-invalid @enderror" type="text" wire:model="time_hours">
                                @error('time_hours')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!--- Time Days Field --->
                            <div class="form-group">
                                <label for="time_days">Time Days</label>
                                <input class="form-control @error('time_days') is-invalid @enderror" type="text" wire:model="time_days">
                                @error('time_days')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!--- Color Field --->
                    <div class="form-group">
                        <label for="name">Color</label>
                        <input class="form-control @error('color') is-invalid @enderror" type="color" wire:model.defer="color">
                        @error('color')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <!--- Save Field --->
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="submit">
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


