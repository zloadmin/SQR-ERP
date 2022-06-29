<?php

namespace Database\Seeders;

use App\Models\SLA;
use App\Models\Stage;
use Illuminate\Database\Seeder;

class SLASeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Stage::all() as $stage) {
            SLA::factory(['stage_id' => $stage->id])->count(rand(30, 90))->create();
        }
    }
}
