<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\User\Models\User;
use App\Game\Models\Game;
use App\Character\Models\Character;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CharacterTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_character(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var Game $game */
        $game = Game::factory()->create();

        /** @var Character $character */
        $character = Character::factory()->create([
            'game_id' => $game->id,
            'user_id' => $user->id
        ]);

        $this
            ->actingAs($user)
            ->getJson(route('api.character.show', ['id' => $character->id]))
            ->assertOk()
            ->assertJson(
                fn (AssertableJson $json) => $json
                    ->has('data', fn (AssertableJson $json) => $json
                        ->where('id', $character->id)
                        ->where('name', $character->name)
                        ->where('game_id', $game->id)
                        ->where('user_id', $user->id)
                        ->whereAllType([
                            'id' => 'integer',
                            'name' => 'string',
                            'game_id' => 'integer',
                            'user_id' => 'integer',
                            'updated_at' => 'string',
                            'created_at' => 'string'
                        ])
                    )
            );
    }
}
