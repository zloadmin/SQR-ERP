<?php

namespace App\Console\Commands\Test;

use App\Clients\Aramex;
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
        $task = Task::find(1561);
        $aramex = (new Aramex($task))->sendCreateShipmentsRequest();
        dd($aramex);
        if(isset($aramex['HasErrors']) && $aramex['HasErrors']) {
            $errors = [];
            if(isset($aramex['Shipments'][0]['Notifications']) && is_array($aramex['Shipments'][0]['Notifications'])) {
                foreach ($aramex['Shipments'][0]['Notifications'] as $data) {
                    if(isset($data['Message'])) {
                        $errors[] = $data['Message'];
                    }
                }
            }
        }
        $this->info(implode(PHP_EOL, $errors));
        return Command::SUCCESS;
    }
}
