<div>
    @foreach($stages as $stage)
        <livewire:stage.show-stage :stage="$stage" :tasks="$stage->tasks"  :wire:key="'stage-' . $stage->id"/>
    @endforeach
</div>
