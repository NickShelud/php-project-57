<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\TaskStatuses;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TaskStatusTest extends TestCase
{
    private User $user;
    private TaskStatuses $taskStatus;
    private string $fakeNameForTaskStatus;
    private string $fakeNameForTaskStatusUpdate;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->taskStatus = TaskStatuses::factory()->create();
        $this->fakeNameForTaskStatus = fake()->name();
        $this->fakeNameForTaskStatusUpdate = fake()->name();
    }

    public function testIndex()
    {
        $response = $this->get(route('task_statuses.index'));

        $response->assertStatus(200);
    }

    public function testCreate()
    {
        $response = $this->actingAs($this->user)->get(route('task_statuses.create'));

        $response->assertOk();
    }

    public function testStore()
    {
        $response = $this
            ->actingAs($this->user)
            ->post(route('task_statuses.store'), [
                'name' => $this->fakeNameForTaskStatus
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('task_statuses', ['name' => $this->fakeNameForTaskStatus]);
        $response->assertRedirect(route('task_statuses.index'));
    }

    public function testStoreNotAuth()
    {
        $response = $this
            ->post(route('task_statuses.store'), [
                'name' => 'newTestStatus'
        ]);

        $response->assertStatus(403);
    }

    public function testEdit()
    {
        $response = $this
            ->actingAs($this->user)
            ->get(route('task_statuses.edit', ['task_status' => $this->taskStatus]));

        $response->assertOk();
    }

    public function testUpdate()
    {
        $response = $this
            ->actingAs($this->user)
            ->patch(route('task_statuses.update', ['task_status' => $this->taskStatus]), [
                'name' => $this->fakeNameForTaskStatusUpdate
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('task_statuses', ['name' => $this->fakeNameForTaskStatusUpdate]);
        $response->assertRedirect(route('task_statuses.index'));
    }

    public function testUpdateNotAuth()
    {
        $response = $this
            ->patch(route('task_statuses.update', ['task_status' => $this->taskStatus]), [
                'name' => 'test'
        ]);

        $response->assertStatus(403);
    }

    public function testDestroy()
    {
        $response = $this
            ->actingAs($this->user)
            ->delete(route('task_statuses.destroy', ['task_status' => $this->taskStatus]));

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('labels', ['id' => $this->taskStatus->id]);
        $response->assertRedirect(route('task_statuses.index'));
    }
}
