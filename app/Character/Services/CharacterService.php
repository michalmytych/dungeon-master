<?php

namespace App\Character\Services;

use App\Character\Models\Character;

class CharacterService
{
    public function find(mixed $id): Character
    {
        return Character::findOrFail($id);
    }
}
