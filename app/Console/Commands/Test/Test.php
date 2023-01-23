<?php

namespace App\Console\Commands\Test;

use App\Jobs\GeneratePreloadQRAttachments;
use App\Models\Task;
use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $task = Task::find(568);
        dd($task->task->getQrAttachmentsFilePaths());
//        var_dump($task);
        GeneratePreloadQRAttachments::dispatchSync($task);
        return Command::SUCCESS;
    }
}
