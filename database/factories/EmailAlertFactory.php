<?php

namespace Database\Factories;

use App\Models\EmailAlert;
use App\Models\Stage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmailAlert>
 */
class EmailAlertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'type' => $this->faker->randomElement(EmailAlert::TYPES),
            'stage_id' => Stage::factory(),
            'recipient_id' => rand(0,1) ? User::factory() : 0,
            'subject' => $this->faker->title,
            'text' => $this->faker->realText(),
        ];
    }
}
