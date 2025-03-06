<?php

namespace Database\Seeders;

use App\Models\Label;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaskStatus;
use App\Models\Task;
use App\Models\User;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIDs = User::query()->pluck('id')->toArray();
        $statusIDs = TaskStatus::query()->pluck('id')->toArray();
        $labelsIDs = Label::query()->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            $task = Task::factory()
                ->create([
                    'created_by_id' => fake()->randomElement($userIDs),
                    'status_id' => fake()->randomElement($statusIDs),
                    'assigned_to_id' => fake()->randomElement($userIDs)
                ]);
            $task->labels()->attach(fake()->randomElement($labelsIDs));
            $task->labels()->attach(fake()->randomElement($labelsIDs));
        }
    }
}
