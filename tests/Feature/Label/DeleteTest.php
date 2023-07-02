<?php

use App\Models\User;
use App\Models\Label;
use App\Models\Tasks;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

test('label should be delete', function () {
    $user = User::factory()->create();
    $label = Label::factory()->create();

    $response = $this
        ->actingAs($user)
        ->delete(route('labels.destroy', ['label' => $label->id]));

    $response->assertSessionHasNoErrors();
    $response->assertRedirect(route('labels.index'));
});

test('label should not be delete', function () {
    $label = Label::factory()->create();

    $response = $this
        ->delete(route('labels.destroy', ['label' => $label->id]));

    $response->assertStatus(403);
});

test('test should not be delete if it is used in task', function () {
    $user = User::factory()->create();
    $label = Label::factory()->create();
    $task = Tasks::factory()->create(['label_id' => $label->id]);

    $response = $this
        ->actingAs($user)
        ->delete(route('labels.destroy', ['label' => $label->id]));

    $this->assertDatabaseHas('tasks', ['label_id' => $label->id]);
    $response->assertRedirect(route('labels.index'));
});
