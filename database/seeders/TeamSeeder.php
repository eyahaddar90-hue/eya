<?php

use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        Team::factory(5)->create(); // Crée 5 équipes
    }
}

