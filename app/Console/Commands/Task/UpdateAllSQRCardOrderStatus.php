<?php

namespace App\Console\Commands\Task;

use App\Models\Task;
use Illuminate\Console\Command;

class UpdateAllSQRCardOrderStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:update-all-sqr-card-order-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all tasks stage status in sqrcard';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach (Task::all() as $task) {
            $task->updateSQRCardOrderStatus();
        }
        return Command::SUCCESS;
    }
}
