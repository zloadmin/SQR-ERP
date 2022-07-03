<?php

namespace App\Console\Commands;

use App\Models\UserRole;
use Illuminate\Console\Command;

class ShowUserRoleVariables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users-roles:variables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show access field names as variables';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach (UserRole::getAccessFieldNames() as $key => $data) {
            $this->info(sprintf('public bool $%s;', $key));
        }
        return 0;
    }
}
