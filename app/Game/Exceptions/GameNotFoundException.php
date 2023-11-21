<?php

namespace App\Game\Exceptions;

use App\Common\Exceptions\DungeonMasterException;

class GameNotFoundException extends DungeonMasterException
{
    protected $message = 'Game was not found by provided data.';

    public function getHttpErrorStatusCode(): int
    {
        return 404;
    }
}
