<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $task->user);
        $this->assertEquals($user->id, $task->user->id);
    }

    /** @test */
    public function it_belongs_to_a_team()
    {
        $team = Team::factory()->create();
        $task = Task::factory()->create(['team_id' => $team->id]);

        $this->assertInstanceOf(Team::class, $task->team);
        $this->assertEquals($team->id, $task->team->id);
    }
}
