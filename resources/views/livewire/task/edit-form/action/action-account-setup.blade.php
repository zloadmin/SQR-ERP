<div class="card">
    <div class="card-header modal-colored-header bg-danger">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Actions {{ $task->stage_id }}</h4>
            <button type="button" class="btn btn-success"  >
                Submit
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <a wire:click="nextAction()">Next</a>
        <a wire:click="prevAction()">Next</a>
        <p style="padding: 100px;text-align: center">Actions coming soon</p>
    </div> <!-- end card-body -->
</div>
