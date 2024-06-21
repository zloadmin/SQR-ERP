<?php

namespace App\Console\Commands\Task;

use App\Jobs\TaskSetCountryCode;
use App\Models\Task;
use Illuminate\Console\Command;

class TasksSetCountryCode extends Command
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
        foreach (Task::where('id', 1918)->get() as $task) {
            $this->info('Add task ' . $task->id);
            TaskSetCountryCode::dispatchSync($task);
        }
        return Command::SUCCESS;
    }
}
