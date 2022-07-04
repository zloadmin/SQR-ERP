<?php

namespace App\Console\Commands\Test;

use App\Models\Stage;
use App\Models\Task;
use Illuminate\Console\Command;

class TestChangeStageId extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:change-stage-id';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change stage ID';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $task = Task::find(1);
        while (true) {
            $stage = Stage::query()->inRandomOrder()->first();
            $this->info('Random stage ' . $stage->name);
//            $task->stage_id = $stage->id;
//            $task->update();
            $task->update(['stage_id' => $stage->id]);
            sleep(2);
        }
        return 0;
    }
}
