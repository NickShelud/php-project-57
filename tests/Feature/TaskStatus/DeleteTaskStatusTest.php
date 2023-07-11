<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\TaskStatuses;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTaskStatusTest extends TestCase
{
    public function testDestroyAuth()
    {
        $user = User::factory()->create();
        $taskStatus = TaskStatuses::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete(route('task_statuses.destroy', ['task_status' => $taskStatus->id]));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('task_statuses.index'));
    }

    public function testDestroyNotAuth()
    {
        $taskStatus = TaskStatuses::factory()->create();

        $response = $this->delete(route('task_statuses.destroy', ['task_status' => $taskStatus->id]));

        $response->assertStatus(403);
    }
}
