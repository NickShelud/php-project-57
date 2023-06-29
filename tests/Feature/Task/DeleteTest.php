<?php

use App\Models\User;
use App\Models\Tasks;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

test('task should be delete', function() {
    $user = User::factory()->create();
    $task = Tasks::factory()->create(['created_by_id' => $user->id]);

    $response = $this
        ->actingAs($user)
        ->delete(route('tasks.destroy', ['task' => $task->id]));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));
});

test('task should not be delete', function() {
    $task = Tasks::factory()->create();

    $response = $this->delete(route('tasks.destroy', ['task' => $task->id]));

    $response->assertStatus(403);
});