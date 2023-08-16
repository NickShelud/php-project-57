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
    private User $user;
    private Tasks $tasks;
    private array $newTaskData;
    private array $taskDataForUpdate;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->tasks = Tasks::factory([
            'created_by_id' => $this->user->id,
        ])->create();

        $this->newTaskData = Tasks::factory()->make()->only([
            'name',
            'description',
            'status_id',
            'assigned_to_id',
        ]);

        $this->taskDataForUpdate = Tasks::factory()->make()->only([
            'name',
            'description',
            'status_id',
            'assigned_to_id',
        ]);
    }

    public function testIndex()
    {
        $response = $this->get(route('tasks.index'));

        $response->assertStatus(200);
    }

    public function testStore()
    {
        $response = $this
            ->actingAs($this->user)
            ->post(route('tasks.store'), $this->newTaskData);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('tasks', $this->newTaskData);
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

    public function testCreate()
    {

        $response = $this
            ->actingAs($this->user)
            ->get(route('tasks.create'));

        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $response = $this
            ->actingAs($this->user)
            ->patch(route('tasks.update', ['task' => $this->tasks->id]), $this->taskDataForUpdate);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('tasks', $this->taskDataForUpdate);
        $response->assertRedirect(route('tasks.index'));
    }

    public function testEdit()
    {
        $response = $this
            ->actingAs($this->user)
            ->get(route('tasks.edit', ['task' => $this->tasks]));

        $response->assertStatus(200);
    }

    public function testDelete()
    {
        $response = $this
            ->actingAs($this->user)
            ->delete(route('tasks.destroy', ['task' => $this->tasks]));

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('tasks', ['id' => $this->tasks->id]);
        $response->assertRedirect(route('tasks.index'));
    }
}
