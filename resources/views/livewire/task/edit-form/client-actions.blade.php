<div class="action_wrapper">
{{--    Not work in another way--}}
    @switch($stage->key)
        @case('design-approval')
            <livewire:task.edit-form.action.action-design-approval :task="$task" :guest="true" />
        @break
        @case('content-approval')
            <livewire:task.edit-form.action.action-content-approval :task="$task" :guest="true" />
        @break
        @default
            <livewire:task.edit-form.action.action-empty />
        @break
    @endswitch
</div>
