<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallApp extends Command
{
    use HasExec;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'i:a';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install app';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//        $this->exec('npm install');
//        $this->exec('npm run dev');
        $this->call('migrate:refresh');
        $this->call('db:seed');

        return 0;
    }
}
