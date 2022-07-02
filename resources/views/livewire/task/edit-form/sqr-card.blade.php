<div class="card">
    <div class="card-header modal-colored-header bg-primary">
        <div class="d-flex justify-content-between align-items-center">
            <h4>SQR CARD</h4>
            <button type="button" class="btn btn-danger"
                    wire:click="$emit('showModal', 'task.edit-form.edit-sqr-card', '{{ $task->id }}')">
                Edit
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-bordered mb-0 border-0" style="    margin-top: -1px;">
            <tbody>
                <tr>
                    <td>
                        <p><b>Username:</b> {{ $task->sqr_card_username }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Password:</b> {{ $task->sqr_card_password }}</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div> <!-- end card-body -->
</div>
