<?php

namespace App\Jobs;


use App\Models\Task;
use App\Models\TaskFile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use ZanySoft\Zip\Zip;

class GeneratePreloadQRAttachments implements ShouldQueue
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
        if($file_names = $this->task->getQrAttachmentsFilePaths()) {
            $zip = Zip::create(TaskFile::getPreloadQRAttachmentsFilePath($this->task));
            $zip->add($file_names);
            return;
        }
        Log::warning('Task doesn\'t have qr attachments');
    }
}
