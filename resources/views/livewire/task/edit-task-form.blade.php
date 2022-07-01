<form wire:submit.prevent="editTask" id="editTaskForm">
    <div class="row">
        <div class="col-md-9">
            <livewire:task.edit-form.order-details :task="$task"/>
            <livewire:task.edit-form.delivery-details :task="$task"/>

        </div>
    </div>
</form>
