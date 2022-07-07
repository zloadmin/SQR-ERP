<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Delete card</h5>
            <button type="button" class="close" wire:click="closeModalDeleteTask">
                <i class="mdi mdi-close"></i>
            </button>
        </div>
        <div class="modal-body">
            <p>Delete card?</p>
        </div>
        <div class="modal-footer">
            <!--- Create Field --->
            <button class="btn btn-danger" wire:click="confirmModalDeleteTask">
                Delete
            </button>
            <button type="button" class="btn btn-secondary" wire:click="closeModalDeleteTask">
                Cancel
            </button>
        </div>
    </div>
</div>
