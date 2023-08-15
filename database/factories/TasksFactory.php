<?php

namespace Database\Factories;

use App\Models\TaskStatuses;
use App\Models\User;
use App\Models\Tasks;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tasks>
 */
class TasksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'status_id' => TaskStatuses::all()->random()->id,
            'created_by_id' => User::all()->random()->id,
            'assigned_to_id' => User::all()->random()->id,
        ];
    }
}
