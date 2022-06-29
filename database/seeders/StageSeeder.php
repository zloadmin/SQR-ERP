<?php

namespace Database\Seeders;

use App\Models\Stage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
    const NAMES = [
        'Account Setup',
        'Design',
        'Design Approval',
        'Content',
        'Content Approval',
        'Print File',
        'Production',
        'Collection',
        'Done',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::NAMES as $name) {
            Stage::factory(['name' => $name])->create();
        }
    }
}
