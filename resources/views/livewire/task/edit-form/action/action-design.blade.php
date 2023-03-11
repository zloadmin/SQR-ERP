<div class="card">
    <div class="card-header modal-colored-header bg-danger">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Action Required: Design</h4>
        </div>
    </div>
    <div class="card-body">
        @include('livewire.task.edit-form.blocks.error')
        <form wire:submit.prevent="submitDesign" id="submitDesignForm">
            <div class="row">
                <div class="col-md-4">
                    @include('livewire.task.edit-form.action.blocks.files')
                </div>
                <div class="col-md-4">
                    @include('livewire.task.edit-form.action.blocks.comment-alert', ['file' => $not_approve_design_file])
                </div>
                <div class="col-md-4">
                    @if ($editable)
                        @include('livewire.task.edit-form.action.blocks.attach-form', ['name' => 'Design'])
                    @endif
                </div>
            </div>
        </form>
    </div> <!-- end card-body -->
</div>
