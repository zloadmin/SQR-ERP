<?php

namespace Database\Seeders;

use App\Models\Stage;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Stage::all() as $stage) {
            Task::factory(['stage_id' => $stage->id])->count(rand(30, 90))->create();
        }
    }
}
