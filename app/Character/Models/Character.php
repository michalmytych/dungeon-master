<?php

namespace App\Character\Models;

use App\Game\Models\Game;
use App\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\CharacterFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed $id
 * @property string $name
 * @property mixed $game_id
 * @property mixed $user_id
 * @method static create(string[] $array)
 */
class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'game_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    protected static function newFactory(): CharacterFactory
    {
        return new CharacterFactory();
    }
}
