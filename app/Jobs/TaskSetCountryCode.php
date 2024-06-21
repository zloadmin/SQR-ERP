<?php

namespace App\Jobs;

use App\Clients\CountryCode;
use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class TaskSetCountryCode implements ShouldQueue
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
        if ($this->task->country) {
            $code = CountryCode::parseCode($this->task->country);
            Log::info('TaskSetCountryCode', [
                'country' => $this->task->country,
                'code' => $code
            ]);
            if ($code) {
                $this->task->update([
                    'country_code' => $code,
                ]);
            }
        }

    }
}
