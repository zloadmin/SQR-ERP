<div class="stage-task-card card mb-0" wire:click="$emit('showModal', 'task.edit-task', '{{ $task->id }}')">
    <div class="card-body p-3">
        <small class="float-end text-muted">{{ $task->updated_at }}</small>
        <span class="badge bg-success">Low</span>
        <h5 class="mt-2 mb-2">
            <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal" class="text-body">
                {{ $task->company_name }}
            </a>
        </h5>
    </div> <!-- end card-body -->
</div>
