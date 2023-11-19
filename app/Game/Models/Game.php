<?php

namespace App\Game\Models;

use Database\Factories\GameFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property mixed $id
 * @property string $name
 * @property string $code
 * @property mixed $master_id
 * @method static firstWhere(string[] $array)
 */
class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'master_id',
        'name',
        'code'
    ];

    protected static function newFactory(): GameFactory
    {
        return new GameFactory();
    }
}
