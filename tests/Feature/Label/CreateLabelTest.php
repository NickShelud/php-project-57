<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateLabelTest extends TestCase
{
    public function testCreateAuth()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('labels.create'));

        $response->assertStatus(200);
    }

    public function testStoreAuth()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('labels.store', ['name' => 'testFakeNameForLabel']));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('labels.index'));
    }

    public function testStoreAuthWithoutParam()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('labels.store'));

        $response->assertSessionHasErrors();
    }

    public function testCreateNotAuth()
    {
        $response = $this->post(route('labels.store', ['name' => 'fakeTestName']));

        $response->assertStatus(403);
    }
}
