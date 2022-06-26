<button type="button" data-toggle="modal" data-target="#confirmModal_{{ $delete_id }}" class="btn btn-link action-icon">
    <i class="mdi mdi-delete"></i>
</button>
@include('livewire.modal.confirm-delete-modal', ['delete_id' =>  $delete_id, ])
