<div class="modal-dialog modal-full-width modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <div class="d-flex justify-content-between align-items-center">
                @if (auth()->user()->canEditTask($task))
                    <button type="button" class="btn btn-success mr-2" wire:click="$emit('showModal', 'task.edit-form.edit-main-info', '{{ $task->id }}')" >
                        Edit
                    </button>
                @endif


                <h5 class=" modal-title">
                    {{ $task->name }}
                    <span class="tag-list ml-2">
                        @foreach($task->tags()->get() as $tag)
                            <span class="badge bg-success">{{ $tag->name }}</span>
                        @endforeach
                    </span>
                </h5>
            </div>

            <button type="button" class="close" wire:click="closeTaskModal()">
                <i class="mdi mdi-close"></i>
            </button>



        </div>
        <div class="modal-body">
            @include('livewire.task.edit-task-form')
        </div>
{{--        <div class="modal-footer d-none">--}}
{{--        --}}{{--            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>--}}
{{--        <!--- Create Field --->--}}
{{--            <button class="btn btn-primary" form="editTaskForm" wire:loading.attr="disabled" wire:target="createTask">--}}
{{--                <div wire:loading.delay wire:target="createTask">--}}
{{--                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>--}}
{{--                    Loading...--}}
{{--                </div>--}}
{{--                <div wire:loading.delay.remove wire:target="createTask">--}}
{{--                    Edit--}}
{{--                </div>--}}
{{--            </button>--}}
{{--        </div>--}}
    </div>
</div>
