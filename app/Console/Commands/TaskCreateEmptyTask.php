<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;

class TaskCreateEmptyTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:create-empty';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create empty task with all field null';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $task = new Task();
        $task->stage_id = 4;
        $task->name = null;
        $task->company_name = null;
        $task->it_is = null;
        $task->material = null;
        $task->total_cards = null;
        $task->instruction = null;
        $task->background = null;
        $task->design_comments = null;
        $task->card_details = null;
        $task->contact_name = null;
        $task->contact_number = null;
        $task->whatsapp = null;
        $task->contact_email = null;
        $task->delivery_method = null;
        $task->emirate = null;
        $task->address = null;
        $task->sqr_card_username = null;
        $task->sqr_card_password = null;
        $task->card_collected = null;
        $task->delivery_reference = null;
        $task->save();
        return 0;
    }
}
