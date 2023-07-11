<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Tasks;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTaskTest extends TestCase
{
    public function testStoreAuth()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('tasks.store'), [
                'name' => 'newTestTask',
                'status_id' => 1
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));
    }

    public function testStoreNotEnoughParam()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('tasks.store'), [
            'name' => 'WrongTask'
        ]);

        $response->assertSessionHasErrors();
    }

    public function testCreateNotAuth()
    {
        $response = $this->get(route('tasks.create'));

        $response->assertStatus(403);
    }

    public function testCreateAuth()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('tasks.create'));

        $response->assertStatus(200);
    }
}
