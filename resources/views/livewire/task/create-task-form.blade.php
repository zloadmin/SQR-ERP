<form wire:submit.prevent="createTask" id="createTaskForm">
    @include('livewire.task.create-task-form.rows.main-row')
    @include('livewire.task.create-task-form.rows.contact-row')
    @include('livewire.task.create-task-form.rows.attachments-row')
</form>
