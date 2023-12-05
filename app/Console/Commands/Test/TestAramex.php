<?php

namespace App\Console\Commands\Test;

use App\Clients\Aramex;
use App\Jobs\TaskCreateShipment;
use App\Models\Task;
use Illuminate\Console\Command;

class TestAramex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:aramex';

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
        $tasks = Task::all();
        $bar = $this->output->createProgressBar($tasks->count());
        foreach ($tasks as $task) {
            TaskCreateShipment::dispatchSync($task);
            $bar->advance();
        }
        $bar->finish();

        return Command::SUCCESS;
    }
}
