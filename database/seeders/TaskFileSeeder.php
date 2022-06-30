<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\TaskFile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Task::all() as $task) {
//            for ($i = 0; $i <= rand(3, 10); $i++) {
                foreach (TaskFile::TYPES as $type) {
//                    TaskFile::factory([ 'task_id' => $task->id, 'type' => $type ])->create();
                }
//            }
        }
    }
}
