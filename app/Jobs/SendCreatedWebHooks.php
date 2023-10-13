<?php

namespace App\Jobs;

use App\Models\Task;
use App\Models\WebHook;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendCreatedWebHooks implements ShouldQueue
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

        if($this->task->isSendWebHook()) {
            $webHooks = WebHook::whereNull('stage_id')->get();
            foreach ($webHooks as $webHook) {
                SendWebHook::dispatch($webHook, $this->task);
            }
        }
    }
}
