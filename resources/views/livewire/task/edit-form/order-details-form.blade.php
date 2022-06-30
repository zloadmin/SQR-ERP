<form wire:submit.prevent="editOrderDetails" id="editOrderDetailsForm">
    @include('livewire.task.create-task-form.rows.main-row')

    @include('livewire.task.create-task-form.rows.attachments-row')
</form>
