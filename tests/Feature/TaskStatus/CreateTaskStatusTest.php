<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\TaskStatuses;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTaskStatusTest extends TestCase
{
    public function testCreateAuth()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('task_statuses.create'));

        $response->assertOk();
    }

    public function testCreateNotAuth()
    {
        $response = $this->get(route('task_statuses.create'));

        $response->assertStatus(403);
    }

    public function testStoreAuth()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('task_statuses.store'), [
                'name' => 'newTestStatus'
        ]);

        $response->assertSessionHasNoErrors();
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
}
