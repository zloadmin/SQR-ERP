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
                            @if($task->company_name)
                                <p><b>Company name:</b> {{ $task->company_name }}</p>
                            @endif
                        </td>
                        <td style="width: 50%; vertical-align: top !important;" rowspan="6">
                            @if($task->card_details)
                                <p><b>Card details:</b><br>
                                    {!! str_replace("\n", '<br />', WL($task->card_details)) !!}
                                </p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @if($task->it_is)
                                <p><b>It is:</b> {{ $task->it_is }}</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @if($task->material)
                                <p><b>Material:</b> {{ $task->material }}</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @if($task->total_cards)
                                <p><b>Total cards:</b> {{ $task->total_cards }}</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @if($task->instruction)
                                <p><b>Print instruction:</b> {!! WL($task->instruction) !!}</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 150px; vertical-align: top!important;">
                            <p>
                                @if($task->design_comments)
                                    <b>Design comments:</b>
                                    <br>
                                    {!! str_replace("\n", '<br />', WL($task->design_comments)) !!}
                                @endif
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
                                wire:click="$emit('showModal', 'task.edit-form.edit-order-attachments', '{{ $task->id }}')">
                            Edit
                        </button>
                    @endif
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered table-centered mb-0 border-0"
                       style="    margin-top: -1px; height: 100%">
                    <tbody>
                    @php
                        $trs = 0;
                    @endphp
                    @if($task->qr_attachments()->count())
                        <tr>
                            <td>
                                <b>QR attachments:</b>
                                <a target="_blank" style="font-weight: bold"
                                   href="{{ route('task.download-attachments', [$task->uuid, \App\Models\TaskFile::QR_ATTACHMENTS]) }}">Download</a>
                            </td>
                        </tr>
                        @php
                            $trs++;
                        @endphp
                    @endif
                    @if ($task->card_details_attachments()->count())
                        <tr>
                            <td>
                                <b>Details attachments:</b>
                                <a target="_blank" style="font-weight: bold"
                                   href="{{ route('task.download-attachments', [$task->uuid, \App\Models\TaskFile::CARD_DETAILS_ATTACHMENTS]) }}">Download</a>
                            </td>
                        </tr>
                        @php
                            $trs++;
                        @endphp
                    @endif
                    @if ($task->design_attachments()->count())
                        <tr>
                            <td>
                                <b>Design attachments:</b>
                                <a target="_blank" style="font-weight: bold"
                                   href="{{ route('task.download-attachments', [$task->uuid, \App\Models\TaskFile::DESIGN_ATTACHMENTS]) }}">Download</a>
                            </td>
                        </tr>
                        @php
                            $trs++;
                        @endphp
                    @endif
                    @if($task->google_attachments && is_array($task->google_attachments))
                        <tr>
                            <td>
                                <b>Google attachments:</b>
                                @foreach($task->google_attachments as $google_attachment)
                                    <a href="{{ $google_attachment }}" target="_blank" style="font-weight: bold">Open</a>
                                @endforeach
                            </td>
                        </tr>
                        @php
                            $trs++;
                        @endphp
                    @endif
                    @if($latest_content_file_attachment)
                        <tr>
                            <td>
                                <b>Approved Content:</b>
                                <p>
                                    @if($latest_content_file_attachment)
                                        <a href="{{ $latest_content_file_attachment->getUrl() }}" target="_blank" style="font-weight: bold">Open</a>
                                    @endif
                                </p>
                            </td>
                        </tr>
                        @php
                            $trs++;
                        @endphp
                    @endif
                    @if ($task->print_file_attachments()->count())
                        <tr>
                            <td>
                                <b>Print File:</b>
                                <a target="_blank" style="font-weight: bold"
                                   href="{{ route('task.download-attachments', [$task->uuid, \App\Models\TaskFile::PRINTING_FILE_ATTACHMENTS]) }}">Download</a>
                            </td>
                        </tr>
                        @php
                            $trs++;
                        @endphp
                    @endif
                    @if ($task->image_of_printed_cards_attachments()->count())
                        <tr>
                            <td>
                                <b>Printed Cards:</b>
                                <a target="_blank" style="font-weight: bold"
                                   href="{{ route('task.download-attachments', [$task->uuid, \App\Models\TaskFile::IMAGE_OF_PRINTED_CARDS_ATTACHMENTS]) }}">Download</a>
                            </td>
                        </tr>
                        @php
                            $trs++;
                        @endphp
                    @endif
                    @if($trs < 7)
                        @for($i = 0; $i < 7 - $trs; $i++)
                            <tr>
                                <td>

                                </td>
                            </tr>
                        @endfor
                    @endif
                    </tbody>
                </table>
            </div> <!-- end card-body -->
        </div>
    </div>

</div>
