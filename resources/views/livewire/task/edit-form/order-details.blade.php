<div class="card">
    <div class="card-header modal-colored-header bg-primary">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Order details</h4>
            <button type="button" class="btn btn-danger" wire:click="$emit('showModal', 'task.edit-form.edit-order-details', '{{ $task->id }}')" >
                Edit
            </button>
        </div>
    </div>
    <div class="card-body">
        <h4 class="header-title">Default Tabs</h4>
        <p class="text-muted font-14 mb-3">Simple widget of tabbable panes of local content.</p>
        <pre>
            {{ var_export($task) }}
        </pre>
    </div> <!-- end card-body -->
</div>
