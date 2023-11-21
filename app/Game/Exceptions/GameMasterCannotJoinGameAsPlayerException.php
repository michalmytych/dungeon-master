<?php

namespace App\Game\Exceptions;

use App\Common\Exceptions\DungeonMasterException;

class GameMasterCannotJoinGameAsPlayerException extends DungeonMasterException
{
    protected $message = 'Game master cannot join game as player and create character.';

    public function getHttpErrorStatusCode(): int
    {
        return 400;
    }
}
