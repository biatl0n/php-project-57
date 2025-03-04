<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        $this->call([
            LabelSeeder::class,
            TaskStatusSeeder::class,
            TaskSeeder::class,
        ]);
    }
}
