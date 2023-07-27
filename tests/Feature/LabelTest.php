<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Label;
use App\Models\Tasks;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LabelTest extends TestCase
{
    use DatabaseTransactions;

    private $user;
    private $label;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->label = Label::factory()->create();
    }

    public function testIndex()
    {
        $response = $this->get(route('labels.index'));

        $response->assertStatus(200);
    }

    public function testCreate()
    {
        $response = $this
            ->actingAs($this->user)
            ->get(route('labels.create'));

        $response->assertStatus(200);
    }

    public function testStore()
    {
        $response = $this
            ->actingAs($this->user)
            ->post(route('labels.store', ['name' => fake()->name()]));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('labels.index'));
    }

    public function testStoreWithoutParam()
    {

        $response = $this
            ->actingAs($this->user)
            ->post(route('labels.store'));

        $response->assertSessionHasErrors();
    }

    public function testEdit()
    {

        $response = $this
            ->actingAs($this->user)
            ->get(route('labels.edit', ['label' => $this->label]));

        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $response = $this
            ->actingAs($this->user)
            ->patch(route('labels.update', ['label' => $this->label, 'name' => fake()->name()]));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('labels.index'));
    }

    public function testUpdateWithoutParam()
    {
        $response = $this
            ->actingAs($this->user)
            ->patch(route('labels.update', ['label' => $this->label->id]));

        $response->assertSessionHasErrors();
    }

    public function testDestroy()
    {

        $response = $this
            ->actingAs($this->user)
            ->delete(route('labels.destroy', ['label' => $this->label->id]));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('labels.index'));
    }
}