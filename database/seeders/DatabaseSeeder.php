<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\Task;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer 3 équipes
        Team::create(['name' => 'Équipe Alpha']);
        Team::create(['name' => 'Équipe Beta']);
        Team::create(['name' => 'Équipe Gamma']);

        // Créer quelques tâches pour ces équipes
        Task::create([
            'title' => 'Tâche 1',
            'description' => 'Description de la tâche 1',
            'team_id' => 1,
        ]);

        Task::create([
            'title' => 'Tâche 2',
            'description' => 'Description de la tâche 2',
            'team_id' => 2,
        ]);

        Task::create([
            'title' => 'Tâche 3',
            'description' => 'Description de la tâche 3',
            'team_id' => 3,
        ]);
    }
}
