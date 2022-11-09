<?php

namespace App\Console\Commands;

use App\Models\SLA;
use App\Models\Stage;
use App\Models\User;
use App\Models\UserRole;
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
//        $this->call('migrate:refresh');
//        Stage::init();
//        SLA::init();
//        UserRole::init();
        User::init();
//        $this->call('db:seed');

        return 0;
    }
}
