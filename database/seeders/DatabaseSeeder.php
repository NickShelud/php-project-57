<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        \App\Models\TaskStatuses::factory()->create([
            'name' => 'Новая'
        ]);

        \App\Models\TaskStatuses::factory()->create([
            'name' => 'Завершена'
        ]);

        \App\Models\TaskStatuses::factory()->create([
            'name' => 'Выполняется'
        ]);

        \App\Models\TaskStatuses::factory()->create([
            'name' => 'В архиве'
        ]);

        \App\Models\Label::factory()->create([
            'name' => 'ошибка',
            'description' => 'Какая-то ошибка в коде или проблема с функциональностью'
        ]);

        \App\Models\Label::factory()->create([
            'name' => 'документация',
            'description' => 'Задача которая касается документации'
        ]);

        \App\Models\Label::factory()->create([
            'name' => 'дубликат',
            'description' => 'Повтор другой задачи'
        ]);

        \App\Models\Label::factory()->create([
            'name' => 'доработка',
            'description' => 'Новая фича, которую нужно запилить'
        ]);
    }
}
