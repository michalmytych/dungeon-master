<?php

namespace App\Game\Services;

use Exception;
use App\User\Models\User;
use App\Game\Models\Game;
use Illuminate\Database\UniqueConstraintViolationException;

class GameService
{
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
