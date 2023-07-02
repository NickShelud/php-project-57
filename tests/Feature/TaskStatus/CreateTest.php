<?php

use App\Models\User;
use App\Models\TaskStatuses;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

test('should be created for user', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('task_statuses.create'));

    $response->assertOk();
});

test('should not be created for guests', function () {
    $response = $this->get(route('task_statuses.create'));

    $response->assertStatus(403);
});

test('should be created new status', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->post(route('task_statuses.store'), [
            'name' => 'newTestStatus'
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('task_statuses.index'));
});
