<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Label;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateLabelTest extends TestCase
{
    public function testEditAuth()
    {
        $user = User::factory()->create();
        $label = Label::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('labels.edit', ['label' => $label->id]));

        $response->assertStatus(200);
    }

    public function testUpdateAuth()
    {
        $user = User::factory()->create();
        $label = Label::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch(route('labels.update', ['label' => $label->id, 'name' => 'fakeTestName']));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('labels.index'));
    }

    public function testUpdateWithoutParam()
    {
        $user = User::factory()->create();
        $label = Label::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch(route('labels.update', ['label' => $label->id]));

        $response->assertSessionHasErrors();
    }

    public function testUpdateNotAuth()
    {
        $label = Label::factory()->create();

        $response = $this
            ->patch(route('labels.update', ['label' => $label->id]));

        $response->assertStatus(403);
    }
}
