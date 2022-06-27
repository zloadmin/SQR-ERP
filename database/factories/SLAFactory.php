<?php

namespace Database\Factories;

use App\Models\SLA;
use App\Models\Stage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SLA>
 */
class SLAFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'name' => $this->faker->name(),
            'type' => $this->faker->randomElement(SLA::getTypesNames()),
            'stage' => $this->faker->randomElement(Stage::getListNames()),
            'time' => $this->faker->randomElement(SLA::TIMES),
        ];
    }
}
