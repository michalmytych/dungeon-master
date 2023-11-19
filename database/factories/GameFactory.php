<?php

namespace Database\Factories;

use Exception;
use App\Game\Models\Game;
use App\Game\Services\GameService;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    protected $model = Game::class;

    /**
     * @throws Exception
     */
    public function definition(): array
    {
        /** @var GameService $gameService */
        $gameService = app(GameService::class);

        return [
            'name' => $this->faker->realText(20),
            'code' => $gameService->generateCode(),
        ];
    }
}
