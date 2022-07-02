<form wire:submit.prevent="editTask" id="editTaskForm">
    <div class="row">
        <div class="col-md-9">
            <livewire:task.edit-form.actions :task="$task"/>
            <livewire:task.edit-form.order-details :task="$task"/>
            <livewire:task.edit-form.delivery-details :task="$task"/>
            <livewire:task.edit-form.sqr-card :task="$task"/>
        </div>
        <div class="col-md-3">
            <livewire:task.edit-form.sla :task="$task"/>
            <livewire:task.edit-form.log :task="$task"/>
        </div>
    </div>
</form>
