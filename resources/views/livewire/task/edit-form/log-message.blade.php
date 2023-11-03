<div class="d-flex align-items-start mt-1 p-2 {{ $log_message->user_id && $log_message->user_id == auth()->id() ? 'bg-light' : '' }}">
    <div class="w-100 overflow-hidden">
        <h5 class="mt-0 mb-0 font-14">
            <span class="float-end text-muted font-12" wire:poll.60s>{{ $log_message->created_at->diffForHumans() }} {{ $log_message->created_at->setTimezone('Asia/Dubai')->format('j M H:i') }}</span>
            <br>
            @if($log_message->user)
                {{ $log_message->user->role_name }} ({{ $log_message->user->email }})
            @else
                Guest
            @endif
        </h5>
        <p class="mt-1 mb-0 text-muted font-14">
            <span class="w-100">{!! $log_message->text !!}</span>
        </p>
    </div>
</div>
