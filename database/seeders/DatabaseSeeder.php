<?php

namespace Database\Seeders;

use App\Game\Models\Game;
use App\User\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\UniqueConstraintViolationException;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(10)->create();

        try {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);

        } catch (UniqueConstraintViolationException) {
            // Probably test user was already seeded.
        }

        Game::factory(20)->create();
    }
}
