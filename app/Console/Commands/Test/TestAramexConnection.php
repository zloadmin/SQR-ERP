<?php

namespace App\Console\Commands\Test;

use App\Clients\Aramex;
use App\Jobs\TaskCreateShipment;
use App\Models\Task;
use Illuminate\Console\Command;

class TestAramexConnection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:aramex-connection';

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

        $aramex = (new Aramex(new Task()))->sendTestCreateShipmentsRequest();
        $this->info($aramex->body());


        return Command::SUCCESS;
    }
}
