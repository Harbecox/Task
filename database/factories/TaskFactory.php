<?php

namespace Database\Factories;

use Carbon\Carbon;
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
    public function definition(): array
    {
        $created_at = $this->faker->dateTimeBetween("-3 day");
        $deadline = Carbon::make($created_at)->addDays($this->faker->randomNumber(1,10));
        return [
            "title" => $this->faker->jobTitle(),
            "description" => $this->faker->realText(500),
            "created_at" => $created_at,
            "updated_at" => $created_at,
            "deadline" => $deadline,
        ];
    }
}
