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
        $statuses = ['new', 'finished', 'processing', 'in archive'];
        foreach ($statuses as $status) {
            TaskStatus::factory()->create(['name' => $status]);
        }
    }
}
