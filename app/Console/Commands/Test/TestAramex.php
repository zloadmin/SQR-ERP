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
        $aramex = (new Aramex())->sendCreateShipmentsRequest();
        dd($aramex);
        return Command::SUCCESS;
    }
}
