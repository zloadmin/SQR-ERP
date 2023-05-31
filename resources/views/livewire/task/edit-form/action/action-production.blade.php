<div class="card">
    <div class="card-header modal-colored-header bg-danger">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Action Required: Production</h4>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                @include('livewire.task.edit-form.blocks.error')
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                @include('livewire.task.edit-form.action.blocks.files')
            </div>
            <div class="col-md-4">
                @if($task->instruction)
                    <h5 class="mt-0 mb-2 font-16">Print instruction</h5>
                    <div class="alert alert-danger">
                        {{ $task->instruction }}
                    </div>
                @endif
            </div>
            <div class="col-md-4">
                @if ($editable)
                    @include('livewire.task.edit-form.action.blocks.approve-form')
                @endif
            </div>
        </div>
    </div> <!-- end card-body -->
</div>
