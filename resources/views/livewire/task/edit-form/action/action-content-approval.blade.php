<div class="card">
    <div class="card-header modal-colored-header bg-danger">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Actions Content Approval</h4>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                @include('livewire.task.edit-form.action.blocks.files')
            </div>

            <div class="col-md-8">
                @if($this->content_attache && $editable)
                    @include('livewire.task.edit-form.action.blocks.approve-decline-form')
                @endif
            </div>
        </div>
    </div> <!-- end card-body -->
</div>
