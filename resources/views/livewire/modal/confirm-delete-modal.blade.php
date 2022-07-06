<!-- Confirm delete modal -->
<div wire:ignore.self class="modal fade" id="confirmModal_{{ $delete_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmModal_{{ $delete_id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $title ?? 'Delete Confirm' }} </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-left">{{ $text ?? 'Are you sure want to delete?' }} </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="delete({{ $delete_id }})" class="btn btn-danger close-modal" data-bs-dismiss="modal">Yes, Delete</button>
            </div>
        </div>
    </div>
</div>
