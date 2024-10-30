<?php

namespace App\Console\Commands\Test;

use App\Models\Task;

use Illuminate\Console\Command;
use App\Clients\CountryCode;
use PragmaRX\Countries\Package\Countries;


class CountryCodeTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:country-code';

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

        CountryCode::parseCode("France");
        foreach (Task::whereNotNull('country')->where('country', '!=', '')->get() as $task) {
            $code = CountryCode::parseCode($task->country);
            if(!$code) {
                var_dump($task->country);
            }
            if($code != 'AE') {
                $this->info($task->country . ' ' . $code);
            }

        }
        return Command::SUCCESS;
    }

}
