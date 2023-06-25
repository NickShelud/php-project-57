<?php

use App\Models\User;
use App\Models\Tasks;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

test('task should be update', function() {
    $user = User::factory()->create();
    $tasks = Tasks::factory()->create();

    $response = $this
        ->actingAs($user)
        ->patch(route('tasks.update', ['task' => $tasks->id]), [
            'name' => $tasks->name
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));
});

test('task should not be update', function() {
    $response = $this->get(route('tasks.update'));

    $response->assertStatus(403);
});

test('guest can\'t edit task', function() {
    $tasks = Tasks::factory()->create();
    $response = $this->get(route('tasks.edit', ['task' => $tasks->id]));

    $response->assertNotStatus(200);
});