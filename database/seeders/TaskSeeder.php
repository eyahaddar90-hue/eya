<?php

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        Task::factory(20)->create(); // Crée 20 tâches
    }
}
