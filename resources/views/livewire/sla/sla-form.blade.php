<div class="card">
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-12">
                <form wire:submit.prevent="submit">
                    <!--- Name Field --->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" wire:model="name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--- Type Field --->
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control @error('type') is-invalid @enderror" wire:model="type">
                            <option value=""></option>
                            @foreach(\App\Models\SLA::TYPES as $type)
                                <option value="{{ $type['name'] }}">{{ $type['name'] }}</option>
                            @endforeach
                        </select>
                        @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--- Stage Field --->
                    <div class="form-group">
                        <label for="stage">Stage</label>
                        <select class="form-control @error('stage_id') is-invalid @enderror" wire:model="stage_id">
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
                    <!--- Time Field --->
                    <div class="form-group">
                        <label for="time">Time</label>
                        <select class="form-control @error('time') is-invalid @enderror" wire:model="time">
                            <option value=""></option>
                            @foreach(\App\Models\SLA::getTimes() as $secs => $secs_title)
                                <option value="{{ $secs }}">{{ $secs_title }}</option>
                            @endforeach
                        </select>
                        @error('time')
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


