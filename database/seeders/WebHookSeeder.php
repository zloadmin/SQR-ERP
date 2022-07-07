<?php

namespace Database\Seeders;

use App\Models\WebHook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebHookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WebHook::factory()->count(rand(15,25))->create();
    }
}
