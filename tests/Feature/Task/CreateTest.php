<?php

use App\Models\User;
use App\Models\Tasks;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

test('task should be created', function() {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->post(route('tasks.store'), [
            'name' => 'newTestTask',
            'status_id' => 1
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));
});

test('task should not be created', function() {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->post(route('tasks.store'), [
            'name' => 'WrongTask'
        ]);

        $response->assertSessionHasErrors();
        $response->assertRedirect(route('tasks.index'));
});

test('guest can\'t create task', function() {
    $response = $this->get(route('tasks.create'));

    $response->assertStatus(403);
});