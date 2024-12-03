<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\TaskStatus;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaskStatus::factory()
            ->count(4)
            ->sequence(
                ['Name' => __('New')],
                ['Name' => __('In progress')],
                ['Name' => __('In testing')],
                ['Name' => __('Complete')],
            )
            ->create();
    }
}
