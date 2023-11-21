<?php

namespace App\Common\Exceptions;

use Exception;

abstract class DungeonMasterException extends Exception
{
    abstract public function getHttpErrorStatusCode(): int;
}
