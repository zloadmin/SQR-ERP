<div class="card">
    <div class="card-header modal-colored-header bg-primary">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Delivery details</h4>
            @if($editable)
                <button type="button" class="btn btn-danger" wire:click="$emit('showModal', 'task.edit-form.edit-delivery-details', '{{ $task->id }}')" >
                    Edit
                </button>
            @endif
        </div>
    </div>
    <div class="card-body p-0">
{{--        Desctop table--}}
        <table class="table table-bordered mb-0 border-0 d-none d-lg-table" style="    margin-top: -1px;">
            <tbody>
            <tr>
                <td style="width: 33%">
                    <p><b>Contact name:</b> {{ $task->contact_name }}</p>
                </td>
                <td style="width: 33%">
                    <p><b>Contact email:</b> {{ $task->contact_email }}</p>
                </td>
                <td style="width: 34%">
                    <p><b>Emirate:</b> {{ $task->emirate }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p><b>Contact number:</b> {{ $task->contact_number }}</p>
                </td>
                <td>
                    <p><b>Delivery method:</b> {{ $task->delivery_method }}</p>
                </td>
                <td rowspan="2" class="align-top">
                    <p><b>Address:</b><br> {{ $task->address }} </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p><b>WhatsApp:</b> {{ $task->whatsapp }}</p>
                </td>
                <td>

                </td>
            </tr>

            </tbody>
        </table>
{{--        Mobile table--}}
        <table class="table table-bordered mb-0 border-0 d-table d-lg-none" style="    margin-top: -1px;">
            <tbody>
            <tr>
                <td style="width: 50%">
                    <p><b>Contact name:</b> {{ $task->contact_name }}</p>
                </td>
                <td style="width: 50%">
                    <p><b>Contact email:</b> {{ $task->contact_email }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p><b>Emirate:</b> {{ $task->emirate }}</p>
                </td>
                <td>
                    <p><b>Contact number:</b> {{ $task->contact_number }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p><b>Delivery method:</b> {{ $task->delivery_method }}</p>
                </td>
                <td rowspan="2" class="align-top">
                    <p><b>Address:</b><br> {{ $task->address }} </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p><b>WhatsApp:</b> {{ $task->whatsapp }}</p>
                </td>

            </tr>

            </tbody>
        </table>
    </div> <!-- end card-body -->
</div>
