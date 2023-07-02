<?php

use App\Models\User;
use App\Models\Tasks;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

test('list should open', function () {
    $response = $this->get(route('tasks.index'));

    $response->assertOk();
});
