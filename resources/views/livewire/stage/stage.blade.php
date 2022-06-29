<div class="tasks">
    <h5 class="mt-0 task-header text-uppercase">
        {{ $stage->name }} ({{ count($stage->tasks) }})
{{--        Updates {{ $updates }}--}}
        @if ($stage->id == 1)

            <!-- Inside existing Livewire component -->
            <button wire:click="$emit('openModal', 'task.create-task')">Edit User</button>
        @endif
    </h5>

    <div id="task-list-two" class="task-list-items">
        @forelse($tasks as $task)
{{--            If include as livewire tag use a lot of memmory (Allowed memory size)--}}
            <div class="card mb-0">
                <div class="card-body p-3">
                    <small class="float-end text-muted">{{ $task->updated_at }}</small>
                    <span class="badge bg-success">Low</span>
                    <h5 class="mt-2 mb-2">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal" class="text-body">
                            {{ $task->name }}
                        </a>
                    </h5>
                </div> <!-- end card-body -->
            </div>
        @empty
            <livewire:task.show-empty-task :wire:key="'stage-empty-'.$stage->id.'-task-'.$task->id"/>
        @endforelse
    </div> <!-- end company-list-2-->
</div>
