<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

test('user can go to create label', function() {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('labels.create'));
    
    $response->assertStatus(200);
});

test('label should be created', function() {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->post(route('labels.store', ['name' => 'testFakeName']));

    $response->assertSessionHasNoErrors();
    $response->assertRedirect(route('labels.index'));
});

test('label should not be created without param', function() {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->post(route('labels.store'));
    
    $response->assertSessionHasErrors();
});

test('guest can\'t created label', function() {
    $response = $this->post(route('labels.store', ['name' => 'fakeTestName']));

    $response->assertStatus(403);
});

