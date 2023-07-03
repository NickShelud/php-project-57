<?php

use App\Models\User;
use App\Models\TaskStatuses;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

test('user can go to update status', function () {
    $user = User::factory()->create();
    $taskStatus = TaskStatuses::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('task_statuses.update', ['task_status' => $taskStatus->id]));

    $response->assertOk();
});

test('guest can\'t go to update status', function () {
    $taskStatus = TaskStatuses::factory()->create();
    $response = $this->patch(route('task_statuses.update', ['task_status' => $taskStatus->id]));

    $response->assertStatus(403);
});

test('should be update status', function () {
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
