@php
    $color = '';
    $currentSLATimeLeftWorkHours = $task->getCurrentSLATimeLeftWorkHours();
    foreach ($slaExpiredColors as $slaExpiredColor) {
        if($currentSLATimeLeftWorkHours > $slaExpiredColor->time) {
            $color = $slaExpiredColor->color;
        }
    }
@endphp
<div class="stage-task-card card mb-0" wire:click="$emit('showModal', 'task.edit-task', '{{ $task->id }}')"
     @if($color) style="background: {{ $color }}" @endif>
    <div class="card-body p-3">
        {{--        <small class="float-end text-muted">Stage time: {{ $task->getCurrentSLATimeLeft() }}</small>--}}
        {{--        <br>--}}
        {{--        <small class="float-end text-muted">Created at: {{ $task->created_at }}</small>--}}
        {{--        <br>--}}
        <h5 class="mt-0">
            <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal" class="text-body text-black">
                {{ $task->name ?: $task->company_name }}
            </a>
        </h5>
        @foreach($task->tags as $tag)
            @if ($tag->color)
                <span class="badge bg-success"
                      style="background-color: {{ $tag->color }} !important; color: white">{{ $tag->name }}</span>
            @else
                <span class="badge bg-success">{{ $tag->name }}</span>
            @endif
        @endforeach


        <div class="d-flex justify-content-between">
            <small class="text-black"><b>Materials:</b> {{ \Illuminate\Support\Str::limit($task->material, 12) }}</small>
            <small class="text-muted text-black">Stage time: {{ $task->getCurrentSLATimeLeft() }}
{{--                ({{ $task->getCurrentSLATimeLeftWorkHoursText() }})--}}
{{--                {{ $s ? $s->id : ''  }}--}}
{{--                {{ $i ? json_encode($i) : ''  }}--}}
            </small>
            {{--            <small class="text-muted">Stage time: {{ $task->getCurrentSLATimeLeftWorkHours() }}</small>--}}
        </div>
        <div class="d-flex justify-content-between">
            <small class="text-black"><b>Cards:</b> {{ $task->total_cards }}</small>
            <small class="text-muted text-black">Created Time: {{ $task->getTimeLeft() }}</small>
        </div>
        <div class="d-flex justify-content-between">
            <small class="text-black">
                @if ($task->country)
                    <b>Country:</b> {{ $task->country }}
                @else
                    &nbsp;
                @endif
            </small>

            <small class="text-muted  text-black">Revisions: {{ $task->getRevisions() }} </small>
        </div>

    </div> <!-- end card-body -->
</div>
