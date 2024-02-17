<?php

namespace App\Console\Commands\Test;

use App\Jobs\GeneratePreloadQRAttachments;
use App\Models\Task;
use App\Models\TelegramAlert;
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

////        dd($task->getQrAttachmentsFilePaths());
////        var_dump($task);
//        GeneratePreloadQRAttachments::dispatchSync($task);
//        $task = Task::find(568);
//        $telegamAlert = TelegramAlert::first();
//        dd($task->getTelegramAlertMessage($telegamAlert));
        $tasks = Task::orWhere('card_details', 'LIKE', '%last_name%')->orWhere('card_details', 'LIKE', '%first_name%')->get();

        foreach ($tasks as $task) {
            $task->updateCardDetailsName();
        }

//        dd($c);

//        dd($task->getCardDetailsFirstNameLine(), $task->getCardDetailsLastNameLine());
        return Command::SUCCESS;
    }
}
