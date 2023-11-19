<?php

namespace App\Game\Exceptions;

use Exception;

class UserAlreadyJoinedGameException extends Exception
{
    protected $message = 'This user already joined this game.';
}
