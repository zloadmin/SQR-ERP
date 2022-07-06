<?php

namespace Database\Seeders;

use App\Models\EmailAlert;
use App\Models\Stage;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmailAlertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Stage::all() as $stage) {
            foreach (EmailAlert::TYPES as $type) {
                for ($i = 0; $i <= rand(1,3); $i++) {
                    if($i) {
                        $user = User::query()->inRandomOrder()->first();
                        EmailAlert::factory()->create([
                            'name' => sprintf('Alert type: %s. Stage: %s. User: %s (%s)', $type, $stage->name, $user->email, $user->role_name),
                            'type' => $type,
                            'stage_id' => rand(0,5) ? $stage->id : null,
                            'recipient_id' => $user->id
                        ]);
                    } else {
                        EmailAlert::factory()->create([
                            'name' => sprintf('Alert type: %s. Stage: %s. User: client', $type, $stage->name),
                            'type' => $type,
                            'stage_id' => rand(0,5) ? $stage->id : null,
                            'recipient_id' => 0
                        ]);
                    }
                }
            }
        }

    }
}
