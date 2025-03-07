<?php

namespace Database\Factories;

use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Label;
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
        if (User::query()->count() < 1) {
            User::factory()->create();
        }

        if (TaskStatus::query()->count() < 1) {
            TaskStatus::factory()->create();
        }

        return [
            'name' => fake()->colorName(),
            'description' => fake()->realText(70),
            'status_id' => TaskStatus::query()->inRandomOrder()->value('id'),
            'created_by_id' => User::query()->inRandomOrder()->first()->value('id')
        ];
    }
}
