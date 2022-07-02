<div>
    @foreach($stages as $stage)
        <livewire:stage.show-stage :stage="$stage"  :wire:key="'stage-' . $stage->id"/>
    @endforeach
</div>
