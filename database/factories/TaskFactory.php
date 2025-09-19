<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

   public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'due_date' => fake()->dateTimeBetween('now', '+1 month'),
            'user_id' => \App\Models\User::factory(), // assigne une tâche à un utilisateur
            'team_id' => \App\Models\Team::factory(), // si tu as une relation team-task
        ];
    }
}
