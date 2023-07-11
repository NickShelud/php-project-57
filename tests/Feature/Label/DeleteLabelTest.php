<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Label;
use App\Models\Tasks;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteLabelTest extends TestCase
{
    public function testDestroyAuth()
    {
        $user = User::factory()->create();
        $label = Label::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete(route('labels.destroy', ['label' => $label->id]));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('labels.index'));
    }

    public function testDestroyNotAuth()
    {
        $label = Label::factory()->create();

        $response = $this
            ->delete(route('labels.destroy', ['label' => $label->id]));

        $response->assertStatus(403);
    }

    public function testDestroyLabelUsedInTask()
    {
        $user = User::factory()->create();
        $label = Label::factory()->create();
        $task = Tasks::factory()->create(['label_id' => $label->id]);

        $response = $this
            ->actingAs($user)
            ->delete(route('labels.destroy', ['label' => $label->id]));

        $this->assertDatabaseHas('tasks', ['label_id' => $label->id]);
        $response->assertRedirect(route('labels.index'));
    }
}
