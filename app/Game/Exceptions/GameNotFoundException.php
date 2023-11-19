<?php

namespace App\Game\Exceptions;

use Exception;

class GameNotFoundException extends Exception
{
    protected $message = 'Game was not found by provided data.';
}
