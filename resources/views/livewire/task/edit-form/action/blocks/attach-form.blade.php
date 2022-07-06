<h5 class="mt-0 mb-2 font-16">Submit file</h5>
@include('livewire.task.edit-form.action.blocks.attache-button')
<button type="button" class="btn btn-success w-100 mt-3" wire:loading.attr="disabled" wire:target="submitAttache" wire:click="submitAttache">
    <div wire:loading.delay wire:target="submitAttache">
        <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
        Loading...
    </div>
    <div wire:loading.delay.remove wire:target="submitAttache">
        Submit
    </div>
</button>
