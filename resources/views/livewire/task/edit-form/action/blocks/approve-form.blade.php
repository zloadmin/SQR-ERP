<h5 class="mt-0 mb-2 font-16">Next Stage</h5>
<!--- Comment Field --->
<div class="row">
    <div class="col-md-12">
        <button type="button" class="btn btn-success w-100" wire:loading.attr="disabled" wire:target="nextActionProduction" wire:click="nextActionProduction">
            <div wire:loading.delay wire:target="nextActionProduction">
                <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                Loading...
            </div>
            <div wire:loading.delay.remove wire:target="nextActionProduction">
                Go to next Stage
            </div>
        </button>
    </div>

</div>
