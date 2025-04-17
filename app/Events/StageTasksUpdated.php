<?php

namespace App\Events;

use App\Http\Livewire\Task\EditForm\Log;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StageTasksUpdated implements ShouldBroadcast
{
    use InteractsWithSockets;
    public int $stage_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(int $stage_id = 1)
    {
        $this->stage_id = $stage_id;
//        \Illuminate\Support\Facades\Log::info('class StageTasksUpdated implements ShouldBroadcast ' . $this->stage_id);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('stages.' . $this->stage_id);
    }
}
