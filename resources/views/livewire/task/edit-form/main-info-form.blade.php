<form wire:submit.prevent="editMainInfo" id="editMainInfoForm">
    <!--- Card Name Field --->
    <div class="form-group">
        <input class="form-control form-control-light @error('name') is-invalid @enderror" type="text" wire:model="name" placeholder="Name">
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <!--- Stage Field --->
    <div class="form-group">
        <select class="form-control form-control-light @error('stage_id') is-invalid @enderror" wire:model="stage_id">
            @foreach($stages as $stage)
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
        <div class="col-12">
            <div class="d-flex">
                @foreach(\App\Models\Tag::all() as $tag)
                    <div class="custom-control custom-switch mr-2">
                        <input wire:model="selected_tags" value="{{ $tag->id }}" type="checkbox" class="custom-control-input" id="tag-{{ $tag->id }}">
                        <label class="custom-control-label" for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

</form>
