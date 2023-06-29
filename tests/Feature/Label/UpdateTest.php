<?php

use App\Models\User;
use App\Models\Label;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

test('user can go to update label', function() {
    $user = User::factory()->create();
    $label = Label::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('labels.edit', ['label' => $label->id]));

    $response->assertStatus(200);
});

test('label should be update', function() {
    $user = User::factory()->create();
    $label = Label::factory()->create();

    $response = $this
        ->actingAs($user)
        ->patch(route('labels.update', ['label' => $label->id, 'name' => 'fakeTestName']));
    
    $response->assertSessionHasNoErrors();
    $response->assertRedirect(route('labels.index'));
});

test('label should not be update without param', function() {
    $user = User::factory()->create();
    $label = Label::factory()->create();

    $response = $this
        ->actingAs($user)
        ->patch(route('labels.update', ['label' => $label->id]));
    
    $response->assertSessionHasErrors();
});

test('guest can\'t update label', function() {
    $label = Label::factory()->create();

    $response = $this
        ->patch(route('labels.update', ['label' => $label->id]));
    
    $response->assertStatus(403);
});