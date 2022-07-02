<div class="modal-dialog modal-full-width modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit order details</h5>
            <button type="button" class="close" wire:click="$emit('showModal', 'task.edit-task', '{{ $task->id }}')">
                <i class="mdi mdi-close"></i>
            </button>
        </div>
        <div class="modal-body">
            @include('livewire.task.edit-form.sqr-card-form')
        </div>
        <div class="modal-footer">
            <!--- Create Field --->
            <button class="btn btn-primary" form="editSQRCardForm" wire:loading.attr="disabled" wire:target="editSQRCard">
                <div wire:loading.delay wire:target="editSQRCard">
                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    Loading...
                </div>
                <div wire:loading.delay.remove wire:target="editSQRCard">
                    Save
                </div>
            </button>
            <button type="button" class="btn btn-secondary" wire:click="$emit('showModal', 'task.edit-task', '{{ $task->id }}')">
                Cancel
            </button>
        </div>
    </div>
</div>
