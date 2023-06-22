<?php

use App\Models\User;
use App\Models\TaskStatuses;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

test('deletion is available to the user', function() {
    $user = User::factory()->create();
    $taskStatus = TaskStatuses::factory()->create();

    $response = $this
        ->actingAs($user)
        ->delete(route('task_statuses.destroy', ['task_status' => $taskStatus->id]));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('task_statuses.index'));
});

test('delete not available for guest', function() {
    $taskStatus = TaskStatuses::factory()->create();

    $response = $this->delete(route('task_statuses.destroy', ['task_status' => $taskStatus->id]));

    $response->assertStatus(403);
});