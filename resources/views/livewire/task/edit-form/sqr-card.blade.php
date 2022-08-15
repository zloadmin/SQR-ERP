<div class="card">
    <div class="card-header modal-colored-header bg-primary">
        <div class="d-flex justify-content-between align-items-center">
            <h4>SQR CARD</h4>
            @if ($editable)
                <button type="button" class="btn btn-danger"
                        wire:click="$emit('showModal', 'task.edit-form.edit-sqr-card', '{{ $task->id }}')">
                    Edit
                </button>
            @endif
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
                        <div class="row">
                            <div class="col-md-6">
                                <p><b>Password:</b> {{ $task->sqr_card_password }}</p>
                            </div>
                            <div class="col-md-6">
                                @if ($task->sqr_card_username && $task->sqr_card_password)
                                    <a  class="btn btn-success float-right" href="{{ $task->getSQRCardClientLoginLink() }}" target="_blank">
                                        Login <i class="mdi mdi-login pr-1"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </td>

                </tr>
            </tbody>
        </table>
    </div> <!-- end card-body -->
</div>
