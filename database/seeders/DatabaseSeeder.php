<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Team;
use App\Models\Task;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer 5 utilisateurs
        User::factory(5)->create();

        // Créer 3 équipes
        Team::factory(3)->create()->each(function ($team) {
            // Pour chaque équipe, créer 3 tâches
            Task::factory(3)->create([
                'team_id' => $team->id,
            ]);
        });
    }
}
