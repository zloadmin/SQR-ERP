<?php

namespace App\Console\Commands\Task;

use App\Jobs\TaskSetCountryCode;
use App\Models\Task;
use Illuminate\Console\Command;

class TasksSetCoountryCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:set-country-codes';

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
        foreach (Task::all() as $task) {
            TaskSetCountryCode::dispatch($task);
        }
        return Command::SUCCESS;
    }
}
