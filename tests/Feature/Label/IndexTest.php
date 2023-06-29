<?php

use App\Models\User;
use App\Models\TaskStatuses;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

test('index was assert status 200', function() {
    $response = $this->get(route('labels.index'));

    $response->assertStatus(200);
});