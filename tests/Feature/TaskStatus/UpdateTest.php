<?php

use App\Models\User;
use App\Models\TaskStatuses;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

test('should be update for user', function() {
    $user = User::factory()->create();
    $taskStatus = TaskStatuses::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('task_statuses.update', ['task_status' => $taskStatus->id]));

    $response->assertOk();
});

test('should not be update for guests', function() {
    $taskStatus = TaskStatuses::factory()->create();
    $response = $this->patch(route('task_statuses.update', ['task_status' => $taskStatus->id]));

    $response->assertStatus(403);
});

test('should be update new status', function() {
    $user = User::factory()->create();
    $taskStatus = TaskStatuses::factory()->create();

    $response = $this
        ->actingAs($user)
        ->patch(route('task_statuses.update', ['task_status' => $taskStatus->id]), [
            'name' => 'test'
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('task_statuses.index'));
});