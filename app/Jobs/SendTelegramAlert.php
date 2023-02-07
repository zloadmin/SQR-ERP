<?php

namespace App\Jobs;

use App\Clients\TelegramApi;
use Illuminate\Support\Facades\Log;
use App\Models\Task;
use App\Models\TelegramAlert;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendTelegramAlert implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;
    public TelegramAlert $telegramAlert;
    public Task $task;
    public int $recipient_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(TelegramAlert $telegramAlert, int $recipient_id, Task $task)
    {
        $this->telegramAlert = $telegramAlert;
        $this->recipient_id = $recipient_id;
        $this->task = $task;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::find($this->recipient_id);
        if($user && $user->telegram_username) {
            $message = $this->task->getTelegramAlertMessage($this->telegramAlert);
            TelegramApi::sendMessage($user->telegram_username, $message, TelegramApi::NEO_Alert_bot);
            return;
        }
        Log::warning('User not found', ['recipient_id' => $this->recipient_id]);
    }
}
