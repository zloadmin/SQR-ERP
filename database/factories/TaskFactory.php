<?php

namespace Database\Factories;

use App\Models\Stage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'stage_id' => Stage::factory(),
            'company_name'    => $this->faker->name(),
            'it_is'           => $this->faker->name(),
            'material'        => $this->faker->name(),
            'total_cards'     => $this->faker->name(),
            'instruction'     => $this->faker->name(),
            'background'      => $this->faker->name(),
            'design_comments' => $this->faker->text(),
            'card_details'    => $this->faker->text(),
            'contact_name'    => $this->faker->name(),
            'contact_number'  => $this->faker->name(),
            'whatsapp'        => $this->faker->name(),
            'contact_email'   => $this->faker->email(),
            'delivery_method' => $this->faker->name(),
            'emirate'         => $this->faker->city(),
            'address'         => $this->faker->address(),
        ];
    }
}
