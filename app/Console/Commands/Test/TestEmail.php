<?php

namespace App\Console\Commands\Test;

use Illuminate\Console\Command;

class TestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return 0;
    }
}
