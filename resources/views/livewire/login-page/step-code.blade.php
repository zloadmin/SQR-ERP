<div class="card-body p-4">
    <div class="text-center w-75 m-auto">
        <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Sign In</h4>
        <p class="text-muted mb-4">Code has been sent to <b>{{ $user->email }}</b>. Also check your spam folder.</p>
    </div>
    <form wire:submit.prevent="sendCode">

        <!--- Code Field --->
        <div class="form-group">
            <label for="code">Code</label>
            <input class="form-control @error('code') is-invalid @enderror" type="text" wire:model="code">
            @error('code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group mb-0 text-center">
            <button class="btn btn-primary" wire:loading.attr="disabled" wire:target="sendCode">
                <div wire:loading.delay wire:target="sendCode">
                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    Loading
                </div>
                <div wire:loading.delay.remove wire:target="sendCode">
                    Log In
                </div>
            </button>
        </div>

    </form>

</div>
