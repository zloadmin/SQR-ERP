<?php

namespace App\Console\Commands\Task;


use App\Models\SLA;
use App\Models\Task;
use Illuminate\Console\Command;

class TaskCheckSla extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:check-sla';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check all task for sla status';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sla = SLA::pluck('time', 'stage_id')->toArray();

        foreach (Task::all() as $task) {
            if(isset($sla[$task->stage_id])) {
                $finish = $task->getStageStart()->addSeconds($sla[$task->stage_id]);
                if($finish->timestamp <= now()->timestamp) {
                    $task->setExpiredSLA();
                }
            }
        }
        return 0;
    }
}
