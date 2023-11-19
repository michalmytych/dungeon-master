<?php

namespace Database\Factories;

use App\Character\Models\Character;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterFactory extends Factory
{
    protected $model = Character::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'game_id' => null,
            'user_id' => null,
        ];
    }
}
