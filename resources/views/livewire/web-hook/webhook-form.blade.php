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
                    <!--- Url Field --->
                    <div class="form-group">
                        <label for="url">Url</label>
                        <input class="form-control @error('url') is-invalid @enderror" type="text" wire:model.defer="url">
                        @error('url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--- Witch Phase Field --->
                    <div class="form-group">
                        <label for="stage_id">Witch Phase</label>
                        <select class="form-control @error('stage_id') is-invalid @enderror" wire:model.defer="stage_id">
                            <option value="">When Created</option>

                            @foreach(\App\Models\Stage::all() as $stage)
                                <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                            @endforeach
                        </select>
                        @error('stage_id')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror


                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Variables</label>
                        </div>
                    </div>
                    @foreach(\App\Models\WebHook::VARIABLES as $variable)
                        <!--- {{ $variable }} Field --->
                        <div class="row">
                            <div class="col-md-12">
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="{{ $variable }}" wire:model.defer="variables"> {{ $variable }}
                                </label>
                            </div>
                        </div>
                    @endforeach
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


