<div class="tasks">
    <h5 class="mt-0 task-header text-uppercase">
        {{ $stage->name }} ({{ count($stage->tasks) }})
{{--        Updates {{ $updates }}--}}
        @if ($stage->id == 1)

            <!-- Inside existing Livewire component -->
{{--            <button wire:click="$emit('openModal', 'task.create-task', {{ json_encode(["user" => 'user']) }})">Edit User</button>--}}
            <!-- Outside of any Livewire component -->

            <button wire:click='$emit("openModal", "task.create-task", {{ json_encode(["stage_id" => $stage->id]) }})'>Edit User</button>
{{--            <button wire:click='$emit("openModal", "edit-user", {{ json_encode(["user" => $user->email]) }})'>Edit User</button>--}}
{{--            <button wire:click='$emit("openModal", "edit-user", {{ json_encode([$user->id, $isAdmin]) }})'>Edit User</button>--}}

                <button type="button" wire:click="$emit('showModal', 'task.create-task', '{{ $stage->id }}')">
                    {{ __('Create Task Stage ID#' . $stage->id) }}
                </button>

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
                        <button type="button" wire:click="$emit('showModal', 'task.edit-task', '{{ $task->id }}')">
                            {{ __('Edit Task #' . $task->id) }}
                        </button>
                    </h5>
                </div> <!-- end card-body -->
            </div>
        @empty
            <livewire:task.show-empty-task :wire:key="'stage-empty-'.$stage->id.'-task-'.$task->id"/>
        @endforelse
    </div> <!-- end company-list-2-->
</div>
