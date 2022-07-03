<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\TaskMessage;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Task::all() as $task) {
            for ($i = 0; $i <= rand(10, 30); $i++) {
                $user = User::query()->inRandomOrder()->first();
                TaskMessage::factory([ 'task_id' => $task->id, 'user_id' => $user->id ])->create();
            }
        }
    }
}
