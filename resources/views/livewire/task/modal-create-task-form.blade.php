<div class="modal-dialog modal-full-width modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Create new card in {{ $stage->name }} stage </h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <i class="mdi mdi-close"></i>
            </button>
        </div>
        <div class="modal-body">
            @include('livewire.task.create-task-form')
        </div>
        <div class="modal-footer">
{{--            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>--}}
            <!--- Create Field --->
            <button class="btn btn-primary" form="createTaskForm" wire:loading.attr="disabled" wire:target="createTask">
                <div wire:loading.delay wire:target="createTask">
                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    Loading...
                </div>
                <div wire:loading.delay.remove wire:target="createTask">
                    Create
                </div>
            </button>
        </div>
    </div>
</div>
