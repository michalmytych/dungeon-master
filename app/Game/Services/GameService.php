<?php

namespace App\Game\Services;

use App\Character\Models\Character;
use App\Game\Events\UserJoinedGame;
use App\Game\Exceptions\UserAlreadyJoinedGameException;
use Exception;
use App\User\Models\User;
use App\Game\Models\Game;
use App\Game\Exceptions\GameNotFoundException;
use Illuminate\Database\UniqueConstraintViolationException;

class GameService
{
    /**
     * @throws GameNotFoundException
     * @throws UserAlreadyJoinedGameException
     */
    public function join(string $code, User $user): Character
    {
        /** @var Game|null $game */
        $game = Game::firstWhere(['code' => $code]);

        if ($game === null) {
            throw new GameNotFoundException();
        }

        $characterForGameAndUserExists = $user
            ->characters()
            ->where('game_id', $game->id)
            ->where('user_id', $user->id)
            ->exists();

        if ($characterForGameAndUserExists) {
            throw new UserAlreadyJoinedGameException();
        }

        $character = Character::create([
            'name' => $user->name . "'s character",
            'game_id' => $game->id,
            'user_id' => $user->id,
        ]);

        UserJoinedGame::dispatch($character->id);

        return $character->load('game');
    }

    /**
     * @throws Exception
     */
    public function create(array $data, User $master): Game
    {
        $game = new Game();

        $game->name = $data['name'];
        $game->code = $this->generateCode();
        $game->master_id = $master->id;

        $saved = false;

        while (!$saved) {
            try {
                $saved = $game->save();

            } catch (UniqueConstraintViolationException) {
                $game->code = $this->generateCode();
            }
        }

        return $game;
    }

    /**
     * @throws Exception
     */
    public function generateCode(int $length = 8): string
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $code = '';

        for ($i = 0; $i < $length; $i++) {
            $randomCharacter = $characters[random_int(0, strlen($characters) - 1)];
            $code .= $randomCharacter;
        }

        return $code;
    }
}
