<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Tasks;
use App\Models\TaskStatuses;
use App\Models\Label;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use DatabaseTransactions;

    private User $user;
    private TaskStatuses $taskStatus;
    private Tasks $tasks;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->taskStatus = TaskStatuses::factory()->create();
        $this->tasks = Tasks::factory([
            'created_by_id' => $this->user->id,
        ])->create();

        $this->newTaskData = Tasks::factory()->make()->only([
            'name',
            'description',
            'status_id',
            'assigned_to_id' => $this->user->id,
        ]);
    }

    public function testIndex()
    {
        $response = $this->get(route('tasks.index'));

        $response->assertStatus(200);
    }

    public function testStoreAuth()
    {
        $response = $this
            ->actingAs($this->user)
            ->post(route('tasks.store'), $this->newTaskData);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));
    }

    public function testStoreNotEnoughParam()
    {

        $response = $this
            ->actingAs($this->user)
            ->post(route('tasks.store'), [
            'name' => 'WrongTask'
        ]);

        $response->assertSessionHasErrors();
    }

    public function testCreateAuth()
    {

        $response = $this
            ->actingAs($this->user)
            ->get(route('tasks.create'));

        $response->assertStatus(200);
    }

    public function testUpdateAuth()
    {
        $response = $this
            ->actingAs($this->user)
            ->patch(route('tasks.update', ['task' => $this->tasks->id]), [
                'name' => $this->tasks->name . $this->tasks->name,
                'status_id' => $this->taskStatus->id,
                'created_by_id' => $this->user->id
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));
    }

    public function testUpdateNotAuth()
    {
        $response = $this->patch(route('tasks.update', ['task' => $this->tasks]), [
            'name' => $this->task->name,
            'status_id' => $this->taskStatuse->id,
            'created_by_id' => $this->user->id
        ]);

        $response->assertStatus(403);
    }

    public function testEditAuth()
    {
        $response = $this
            ->actingAs($this->user)
            ->get(route('tasks.edit', ['task' => $this->tasks]));

        $response->assertStatus(200);
    }

    public function testDeleteAuth()
    {
        $response = $this
            ->actingAs($this->user)
            ->delete(route('tasks.destroy', ['task' => $this->tasks]));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));
    }
}