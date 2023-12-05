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
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendWebHook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;
    public WebHook $webHook;
    public Task $task;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(WebHook $webHook, Task $task)
    {
        $this->webHook = $webHook;
        $this->task = $task;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Http::post($this->webHook->url, $this->task->getWebHookData($this->webHook));
        } catch (\Exception $exception) {
            Log::error('SendWebHook::handle ' . $exception->getMessage());
        }
//        $response = Http::post($this->webHook->url, $this->task->getWebHookData($this->webHook));
//        if(!$response->ok()) {
//            $this->release(5);
//        }
    }
}
