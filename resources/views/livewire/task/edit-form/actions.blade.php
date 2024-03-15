<div class="action_wrapper">
{{--    Not work in another way--}}
    @switch($stage->key)
        @case('account-setup')
            <livewire:task.edit-form.action.action-account-setup :task="$task" />
        @break
        @case('rm-support')
            <livewire:task.edit-form.action.action-r-m-support :task="$task" />
        @break
        @case('design')
            <livewire:task.edit-form.action.action-design :task="$task" />
        @break
        @case('design-approval')
            <livewire:task.edit-form.action.action-design-approval :task="$task" />
        @break
        @case('content')
            <livewire:task.edit-form.action.action-content :task="$task" />
        @break
        @case('content-approval')
            <livewire:task.edit-form.action.action-content-approval :task="$task" />
        @break
        @case('print-file')
            <livewire:task.edit-form.action.action-print-file :task="$task" />
        @break
        @case('qa')
            <livewire:task.edit-form.action.action-q-a :task="$task" />
        @break
        @case('production')
            <livewire:task.edit-form.action.action-production :task="$task" />
        @break
        @case('collection')
            <livewire:task.edit-form.action.action-collection :task="$task" />
        @break
        @case('done')
            <livewire:task.edit-form.action.action-done :task="$task" />
        @break
    @endswitch
</div>
