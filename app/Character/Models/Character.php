<?php

namespace App\Character\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\CharacterFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property mixed $id
 * @property string $name
 */
class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected static function newFactory(): CharacterFactory
    {
        return new CharacterFactory();
    }
}
