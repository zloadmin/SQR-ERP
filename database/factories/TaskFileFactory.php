<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\TaskFile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskFile>
 */
class TaskFileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'task_id' => Task::factory(),
            'path' => $this->faker->filePath(),
            'original_name' => $this->faker->word . '.' . $this->faker->fileExtension(),
            'size' => $this->faker->randomDigit(),
            'type' => $this->faker->randomElement(TaskFile::TYPES),
        ];
    }
}
