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
                    <!--- Alert type Field --->
                    <div class="form-group">
                        <label for="type">Alert type</label>
                        <select class="form-control @error('type') is-invalid @enderror" wire:model="type">
                            @foreach(\App\Models\EmailAlert::TYPES as $type)
                                <option value="{{ $type }}">{{ \Illuminate\Support\Str::title($type) }}</option>
                            @endforeach
                        </select>
                        @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--- Witch Phase Field --->
                    <div class="form-group">
                        <label for="stage_id">Witch Phase</label>
                        <select class="form-control @error('stage_id') is-invalid @enderror" wire:model="stage_id">
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
                    <!--- ALert to Field --->
                    <div class="form-group">
                        <label for="recipient_id">ALert to</label>
                        <select class="form-control @error('recipient_id') is-invalid @enderror" wire:model="recipient_id">
                            <option value="0">Client</option>
                            @foreach(\App\Models\User::all() as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->role_name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('recipient_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--- Subject Field --->
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input class="form-control @error('subject') is-invalid @enderror" type="text" wire:model="subject">
                        @error('subject')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--- Text Field --->
                    <div class="form-group">
                        <label for="text">Text</label>
                        <textarea class="form-control @error('text') is-invalid @enderror" wire:model="text" rows="5"></textarea>
                        @error('text')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="alert alert-secondary bg-transparent text-secondary" role="alert">
                        Variables for text
                        @foreach(\App\Models\Task::EMAIL_VARIABLE_BLOCK as $value)
                            <br>
                            <strong>
                                @php
                                    echo '{{' . $value['key'] . '}}';
                                @endphp
                            </strong> - {{ $value['text'] }}
                        @endforeach


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


