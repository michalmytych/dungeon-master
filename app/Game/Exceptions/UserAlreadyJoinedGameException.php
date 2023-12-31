<?php

namespace App\Game\Exceptions;

use App\Common\Exceptions\DungeonMasterException;

class UserAlreadyJoinedGameException extends DungeonMasterException
{
    protected $message = 'This user already joined this game.';

    public function getHttpErrorStatusCode(): int
    {
        return 400;
    }
}
