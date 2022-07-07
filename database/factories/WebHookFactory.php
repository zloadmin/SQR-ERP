<?php

namespace Database\Factories;

use App\Models\Stage;
use App\Models\WebHook;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WebHook>
 */
class WebHookFactory extends Factory
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
            'url' => $this->faker->url,
            'stage_id' => $this->faker->randomElement(Stage::getListIDs()),
            'variables' => $this->faker->randomElements(WebHook::VARIABLES, rand(1, count(WebHook::VARIABLES)))
        ];
    }
}
