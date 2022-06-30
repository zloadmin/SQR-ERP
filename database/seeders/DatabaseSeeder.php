<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserRoleSeeder::class,
            UserSeeder::class,
            StageSeeder::class,
            SLASeeder::class,
            TagSeeder::class,
            TaskSeeder::class,
            TaskFileSeeder::class,
        ]);

    }
}
