<?php

namespace App\Game\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class UserJoinedGame
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public readonly mixed $characterId) {}
}
