<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Team;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_task()
    {
        // Création d'un utilisateur et d'une équipe
        $user = User::factory()->create();
        $team = Team::factory()->create();

        // Simuler la connexion
        $this->actingAs($user);

        // Données de la tâche
        $taskData = [
            'title' => 'Nouvelle tâche',
            'description' => 'Description de la tâche',
            'due_date' => now()->addDays(7)->format('Y-m-d'),
            'team_id' => $team->id,
            'status' => 'open',
        ];

        // Appel POST pour créer la tâche
        $response = $this->post(route('tasks.store'), $taskData);

        // Vérifie la redirection
        $response->assertRedirect(route('tasks.index'));

        // Vérifie que la tâche est dans la base
        $this->assertDatabaseHas('tasks', [
            'title' => 'Nouvelle tâche',
            'team_id' => $team->id,
        ]);
    }

    /** @test */
    public function a_user_can_update_a_task()
    {
        $user = User::factory()->create();
        $team = Team::factory()->create();
        $task = Task::factory()->create([
            'team_id' => $team->id,
        ]);

        $this->actingAs($user);

        $updatedData = [
            'title' => 'Titre mis à jour',
            'description' => 'Nouvelle description',
            'due_date' => now()->addDays(10)->format('Y-m-d'),
            'team_id' => $team->id,
            'status' => 'closed',
        ];

        $response = $this->patch(route('tasks.update', $task->id), $updatedData);

        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Titre mis à jour',
            'status' => 'closed',
        ]);
    }
}
