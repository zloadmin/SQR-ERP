<?php

namespace Database\Factories;

use App\Models\UserRole;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserRole>
 */
class UserRoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $role = [];
        $role['name'] = $this->faker->name();
        $role['settings'] = false;
        foreach (UserRole::getAccessFieldNames() as $key => $value) {
            $role[$key] = (bool)rand(0,1);
        }
        return $role;
    }
}
