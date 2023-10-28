<div class="tasks">

    <h5 class="mt-0 task-header text-uppercase" style="background: #b2d2ff">
        <div class="d-flex justify-content-between align-items-center">
            <span>{{ $stage->name }} ({{ count($this->tasks) }})</span>
            @if ($stage->id == 4 || $stage->id == 1)
                <button type="button" class="btn btn-danger" wire:click="$emit('showModal', 'task.create-task', '{{ $stage->id }}')">
                    <i class="mdi mdi-plus mr-1"></i>
                    New card
                </button>
            @endif
        </div>
    </h5>


    <div id="task-list-two" class="task-list-items">
        @forelse($tasks as $task)
{{--            If include as livewire tag use a lot of memmory (Allowed memory size)--}}
{{--            <livewire:task.show-task />--}}
            @include('livewire.task.task')
        @empty
            <livewire:task.show-empty-task />
        @endforelse
    </div> <!-- end company-list-2-->
</div>
