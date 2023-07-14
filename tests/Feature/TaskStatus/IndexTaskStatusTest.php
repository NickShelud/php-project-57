<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\TaskStatuses;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTaskStatusTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get(route('task_statuses.index'));

        $response->assertStatus(200);
    }
}
