<button type="button" data-bs-toggle="modal" data-bs-target="#confirmModal_{{ $delete_id }}" class="btn btn-link action-icon">
    <i class="mdi mdi-delete"></i>
</button>
@include('livewire.modal.confirm-delete-modal', ['delete_id' =>  $delete_id, ])
