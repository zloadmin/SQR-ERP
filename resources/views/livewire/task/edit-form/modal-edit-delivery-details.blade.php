<div class="modal-dialog modal-full-width modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit delivery details</h5>
            <button type="button" class="close" wire:click="$emit('showModal', 'task.edit-task', '{{ $task->id }}')">
                <i class="mdi mdi-close"></i>
            </button>
        </div>
        <div class="modal-body">
            @include('livewire.task.edit-form.delivery-details-form')
        </div>
        <div class="modal-footer">
            <!--- Create Field --->
            <button class="btn btn-primary" form="editDeliveryDetailsForm" wire:loading.attr="disabled" wire:target="editDeliveryDetails">
                <div wire:loading.delay wire:target="editDeliveryDetails">
                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    Loading...
                </div>
                <div wire:loading.delay.remove wire:target="editDeliveryDetails">
                    Save
                </div>
            </button>
            <button type="button" class="btn btn-secondary" wire:click="$emit('showModal', 'task.edit-task', '{{ $task->id }}')">
                Cancel
            </button>
        </div>
    </div>
</div>
