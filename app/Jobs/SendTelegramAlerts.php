<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Log;
use App\Models\Task;
use App\Models\TelegramAlert;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendTelegramAlerts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Task $task;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $telegramAlerts = TelegramAlert::where('stage_id', $this->task->stage_id)->get();
        foreach ($telegramAlerts as $telegramAlert) {
            foreach ($telegramAlert->recipient_ids as $recipient_id) {
                Log::info('SendTelegramAlerts', ['recipient_id' => $recipient_id, 'telegramAlert ID' => $telegramAlert->id]);
                SendTelegramAlert::dispatch($telegramAlert, $recipient_id, $this->task);
            }
        }
    }
}
