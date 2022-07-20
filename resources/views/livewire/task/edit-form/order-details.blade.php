<div class="card">
    <div class="card-header modal-colored-header bg-primary">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Order details</h4>
            @if ($editable)
                <button type="button" class="btn btn-danger" wire:click="$emit('showModal', 'task.edit-form.edit-order-details', '{{ $task->id }}')" >
                    Edit
                </button>
            @endif
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-bordered table-centered mb-0 border-0" style="    margin-top: -1px;">
            <tbody>
                <tr>
                    <td style="width: 33%">
                        <p><b>Company name:</b> {{ $task->company_name }}</p>
                    </td>
                    <td style="width: 33%">
                        <p><b>Total cards:</b> {{ $task->total_cards }}</p>
                    </td>
                    <td style="width: 34%">
                        <p>
                            <b>Design attachments:</b>
                            {{ $task->design_attachments()->count() }} files
                            @if($latest_design_attachments_attachment)
                                <br>
                                {!! $latest_design_attachments_attachment->getHTMLLink() !!}
                            @endif
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>It is:</b> {{ $task->it_is }}</p>
                    </td>
                    <td>
                        <p><b>Background:</b> {{ $task->background }}</p>
                    </td>
                    <td>
{{--                        <p>--}}
{{--                            <b>Details attachments:</b>--}}
{{--                            {{ $task->card_details_attachments()->count() }} files--}}
{{--                            @if($latest_design_attachments_attachment)--}}
{{--                                <br>--}}
{{--                                {!! $latest_design_attachments_attachment->getHTMLLink() !!}--}}
{{--                            @endif--}}
{{--                        </p>--}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Material:</b> {{ $task->material }}</p>
                    </td>
                    <td>
                        <p><b>Instruction:</b> {{ $task->instruction }}</p>
                    </td>
                    <td>
                        <p>
                            <b>QR attachments:</b>
                            {{ $task->qr_attachments()->count() }} files
                            @if($latest_qr_attachments_attachment)
                                <br>
                                {!! $latest_qr_attachments_attachment->getHTMLLink() !!}
                            @endif
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            <b>Design comments:</b>
                            <br>
                            {!! str_replace("\n", '<br />', $task->design_comments) !!}
                        </p>
                    </td>
                    <td>
                        <p><b>Card details:</b><br>
                            {!! str_replace("\n", '<br />', $task->card_details) !!}
                        </p>
                    </td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            <b>Approved Design:</b>
                            @if($latest_design_file_attachment)
                                <br>
                                {!!  $latest_design_file_attachment->getHTMLLink()  !!}
                            @endif
                        </p>
                    </td>
                    <td>
                        <p>
                            <b>Approved Content:</b>
                            @if($latest_content_file_attachment)
                                <br>
                                {!! $latest_content_file_attachment->getHTMLLink()  !!}
                            @endif
                        </p>
                    </td>
                    <td>
                        <p>
                            <b>Print File:</b>
                            @if($latest_print_file_attachment)
                                <br>
                                {!! $latest_print_file_attachment->getHTMLLink() !!}
                            @endif
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div> <!-- end card-body -->
</div>
