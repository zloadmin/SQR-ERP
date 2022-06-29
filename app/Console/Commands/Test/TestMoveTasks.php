<?php

namespace App\Console\Commands\Test;

use App\Models\Stage;
use App\Models\Task;
use Illuminate\Console\Command;

class TestMoveTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:move-tasks {--limit=10000}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Move tasks randomly';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $limit = (int)$this->option('limit');

        for ($i = 0; $i <= $limit; $i++){
            $stage = Stage::inRandomOrder()->first();
            $task = Task::where('stage_id', '!=', $stage)->inRandomOrder()->first();
            $this->info(sprintf('Update task ID: %d. Old stage ID: %d. New stage ID: %d', $task->id, $task->stage_id, $stage->id));
            $task->update(['stage_id' => $stage->id]);
//            sleep(2);
        }
        return 0;
    }
}
