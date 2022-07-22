<div class="card">
    <div class="card-header modal-colored-header bg-danger">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Action Required: {{ $task->stage_id }}</h4>
            <button type="button" class="btn btn-success"  >
                Submit
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <p>Current {{ $task->stage_id }}</p>
        <br>
        <a wire:click="nextAction()">Next {{ $task->getNextStageId()  }}</a>
        <br>
        <br>
        <a wire:click="prevAction()">Prev {{ $task->getPrevStageId()  }}</a>
        <p style="padding: 100px;text-align: center">Main action template</p>
    </div> <!-- end card-body -->
</div>

