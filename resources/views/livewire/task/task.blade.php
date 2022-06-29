<div class="card mb-0">
    <div class="card-body p-3">
        <small class="float-end text-muted">{{ $task->created_at }}</small>
        <span class="badge bg-success">Low</span>
        <h5 class="mt-2 mb-2">
            <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal" class="text-body">
                {{ $task->name }}
            </a>
        </h5>
    </div> <!-- end card-body -->
</div>
