<?php

namespace App\Game\Models;

use Database\Factories\GameFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string $name
 * @property string $code
 */
class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code'
    ];

    protected static function newFactory(): GameFactory
    {
        return new GameFactory();
    }
}
