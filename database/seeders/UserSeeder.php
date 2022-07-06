<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        User::factory([
//            'name' => 'Test Admin',
//            'email' => 'admin@admin.com',
//            'password' => Hash::make('admin@admin.com'),
//            'password_unsafe' => 'admin@admin.com',
//            'role_id' => 1
//        ])->create();

         foreach (UserRole::all() as $role) {
             User::factory([
                 'role_id' => $role->id
             ])->count(rand(5,15))->create();
         }
    }
}
