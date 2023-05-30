<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header modal-colored-header bg-primary">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>Order details</h4>
                    @if ($editable)
                        <button type="button" class="btn btn-danger"
                                wire:click="$emit('showModal', 'task.edit-form.edit-order-details', '{{ $task->id }}')">
                            Edit
                        </button>
                    @endif
                </div>
            </div>
            <div class="card-body p-0">
                {{--        Table desktop--}}
                <table class="table table-bordered table-centered mb-0 border-0"
                       style="    margin-top: -1px;">
                    <tbody>
                    <tr>
                        <td style="width: 50%">
                            <p><b>Company name:</b> {{ $task->company_name }}</p>
                        </td>
                        <td style="width: 50%; vertical-align: top !important;" rowspan="6">
                            <p><b>Card details:</b><br>
                                {!! str_replace("\n", '<br />', WL($task->card_details)) !!}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><b>It is:</b> {{ $task->it_is }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><b>Material:</b> {{ $task->material }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><b>Total cards:</b> {{ $task->total_cards }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><b>Print instruction:</b> {!! WL($task->instruction) !!}</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 150px; vertical-align: top!important;">
                            <p>
                                <b>Design comments:</b>
                                <br>
                                {!! str_replace("\n", '<br />', WL($task->design_comments)) !!}
                            </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div> <!-- end card-body -->
        </div>
    </div>
    <div class="col-md-4">
        <div class="card" style="height: 558px">
            <div class="card-header modal-colored-header bg-primary">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>Attachments</h4>
                    @if ($editable)
                        <button type="button" class="btn btn-danger"
                                wire:click="$emit('showModal', 'task.edit-form.edit-order-details', '{{ $task->id }}')">
                            Edit
                        </button>
                    @endif
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered table-centered mb-0 border-0"
                       style="    margin-top: -1px; height: 100%">
                    <tbody>
                    <tr>
                        <td>
                            <b>QR attachments:</b>
                            @if($task->qr_attachments()->count())
                                <a target="_blank" style="font-weight: bold"
                                   href="{{ route('task.download-attachments', [$task->uuid, \App\Models\TaskFile::QR_ATTACHMENTS]) }}">Download</a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Details attachments:</b>
                            @if ($task->card_details_attachments()->count())
                                <a target="_blank" style="font-weight: bold"
                                   href="{{ route('task.download-attachments', [$task->uuid, \App\Models\TaskFile::CARD_DETAILS_ATTACHMENTS]) }}">Download</a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Design attachments:</b>
                            @if ($task->design_attachments()->count())
                                <a target="_blank" style="font-weight: bold"
                                   href="{{ route('task.download-attachments', [$task->uuid, \App\Models\TaskFile::DESIGN_ATTACHMENTS]) }}">Download</a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Google attachments:</b>
                            @if($task->google_attachments && is_array($task->google_attachments))
                                @foreach($task->google_attachments as $google_attachment)
                                    <a href="{{ $google_attachment }}" target="_blank" style="font-weight: bold">Open</a>
                                @endforeach
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Approved Content:</b>
                            @if($latest_content_file_attachment)
                                <p>
                                    @if($latest_content_file_attachment)
                                        <a href="{{ $latest_content_file_attachment->getUrl() }}" target="_blank" style="font-weight: bold">Open</a>
                                    @endif
                                </p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Print File:</b>
                            @if ($task->print_file_attachments()->count())
                                <a target="_blank" style="font-weight: bold"
                                   href="{{ route('task.download-attachments', [$task->uuid, \App\Models\TaskFile::PRINTING_FILE_ATTACHMENTS]) }}">Download</a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Printed Cards:</b>
                            @if ($task->image_of_printed_cards_attachments()->count())
                                <a target="_blank" style="font-weight: bold"
                                   href="{{ route('task.download-attachments', [$task->uuid, \App\Models\TaskFile::IMAGE_OF_PRINTED_CARDS_ATTACHMENTS]) }}">Download</a>
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div> <!-- end card-body -->
        </div>
    </div>

</div>
