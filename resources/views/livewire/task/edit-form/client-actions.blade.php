<div class="action_wrapper">
{{--    Not work in another way--}}
    @switch($stage->key)
        @case('design-approval')
            <livewire:task.edit-form.action.action-design-approval :task="$task" />
        @break
        @case('content-approval')
            <livewire:task.edit-form.action.action-content-approval :task="$task" />
        @break
        @default
            <livewire:task.edit-form.action.action-empty />
        @break
    @endswitch
</div>
