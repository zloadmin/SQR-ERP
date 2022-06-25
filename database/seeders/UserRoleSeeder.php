<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         UserRole::factory()->create([ 'name' => 'Admin', 'settings' => true ]);
         UserRole::factory()->create([ 'name' => 'Manager' ]);
         UserRole::factory()->create([ 'name' => 'Designer' ]);
         UserRole::factory()->create([ 'name' => 'Print Designer' ]);
         UserRole::factory()->create([ 'name' => 'Account Setup' ]);
         UserRole::factory()->create([ 'name' => 'Operator' ]);
         UserRole::factory()->create([ 'name' => 'Client' ]);
    }
}
