<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\TaskStatuses;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class UpdateTaskStatusTest extends TestCase
{
    public function testEditAuth()
    {
        $user = User::factory()->create();
        $taskStatus = TaskStatuses::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('task_statuses.edit', ['task_status' => $taskStatus->id]));

        $response->assertOk();
    }

    public function testEditNotAuth()
    {
        $taskStatus = TaskStatuses::factory()->create();
        $response = $this->get(route('task_statuses.edit', ['task_status' => $taskStatus->id]));

        $response->assertStatus(403);
    }

    public function testUpdateAuth()
    {
        $user = User::factory()->create();
        $taskStatus = TaskStatuses::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch(route('task_statuses.update', ['task_status' => $taskStatus->id]), [
                'name' => 'test'
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('task_statuses.index'));
    }

    public function testUpdateNotAuth()
    {
        $taskStatus = TaskStatuses::factory()->create();

        $response = $this
            ->patch(route('task_statuses.update', ['task_status' => $taskStatus->id]), [
                'name' => 'test'
        ]);

        $response->assertStatus(403);
    }
}
