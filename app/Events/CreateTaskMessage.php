<?php

namespace App\Events;

use App\Models\TaskMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateTaskMessage implements ShouldBroadcast
{
    use InteractsWithSockets;




    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public TaskMessage $taskMessage)
    {

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('message_task.' . $this->taskMessage->task_id);
    }
}
