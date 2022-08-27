<?php

namespace App\Jobs;

use App\Models\Task;
use App\Models\TaskFile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\File;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use LaravelQRCode\Facades\QRCode;

//use LaravelQRCode\Facades\QRCode;

class GenerateQRCodeAttachment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Task $task;
    public string $url;
    public string $slug;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Task $task, string $url, string $slug)
    {
        $this->task = $task;
        $this->url = $url;
        $this->slug = $slug;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $this->saveQRFile();
        $this->createTaskFile();
    }
    private function saveQRFile() : void
    {
        QRCode::url($this->url)
            ->setOutfile($this->getQRPath())
            ->setSize(32)
            ->setMargin(2)
            ->svg();
    }
    private function createTaskFile()
    {
        TaskFile::create([
            'task_id'       => $this->task->id,
            'type'          => TaskFile::QR_ATTACHMENTS,
            'path'          => $this->getStorePath(),
            'original_name' => $this->getFileName(),
            'size'          => filesize($this->getQRPath()),
            'user_id'       => null,
        ]);
    }
    private function getQRPath() : string
    {
        return storage_path('app/public/tasks/qr_attachments/' . $this->getFileName() );
    }
    private function getStorePath() : string
    {
        return 'tasks/qr_attachments/' . $this->getFileName();
    }
    private function getFileName() : string
    {
        return $this->slug . '-web.svg';
    }
}
