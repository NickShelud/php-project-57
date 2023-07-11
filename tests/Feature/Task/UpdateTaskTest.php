<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Tasks;
use App\Models\TaskStatuses;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTaskTest extends TestCase
{
    public function testUpdateAuth()
    {
        $user = User::factory()->create();
        $tasks = Tasks::factory()->create();
        $status = TaskStatuses::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch(route('tasks.update', ['task' => $tasks->id]), [
                'name' => $tasks->name . $tasks->name,
                'status_id' => $status->id,
                'created_by_id' => $user->id
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));
    }

    public function testUpdateNotAuth()
    {
        $user = User::factory()->create();
        $tasks = Tasks::factory()->create();
        $status = TaskStatuses::factory()->create();

        $response = $this->patch(route('tasks.update', ['task' => $tasks->id]), [
            'name' => $tasks->name,
            'status_id' => $status->id,
            'created_by_id' => $user->id
        ]);

        $response->assertStatus(403);
    }

    public function testEditNotAuth()
    {
        $tasks = Tasks::factory()->create();
        $response = $this->get(route('tasks.edit', ['task' => $tasks->id]));

        $response->assertStatus(403);
    }

    public function testEditAuth()
    {
        $user = User::factory()->create();
        $tasks = Tasks::factory()->create();
        $response = $this
            ->actingAs($user)
            ->get(route('tasks.edit', ['task' => $tasks->id]));

        $response->assertStatus(200);
    }
}
