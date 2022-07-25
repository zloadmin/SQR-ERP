<div class="stage-task-card card mb-0" wire:click="$emit('showModal', 'task.edit-task', '{{ $task->id }}')">
    <div class="card-body p-3">
        <small class="float-end text-muted">Time passed: {{ $task->getTimeLeft() }}</small>
        <br>
{{--        <small class="float-end text-muted">Created at: {{ $task->created_at }}</small>--}}
{{--        <br>--}}
        @foreach($task->tags as $tag)
            <span class="badge bg-success">{{ $tag->name }}</span>
        @endforeach
        <h5 class="mt-2 mb-2">
            <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal" class="text-body">
                {{ $task->name ?: $task->company_name }}
            </a>
        </h5>
    </div> <!-- end card-body -->
</div>
