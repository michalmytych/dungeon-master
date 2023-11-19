<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\User\Models\User;
use App\Game\Models\Game;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GameTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_create_game(): void
    {
        $postData = [
            'name' => 'My new D&D game!',
        ];

        /** @var User $user */
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->postJson(route('api.game.create'), $postData);

        $response->assertCreated();

        /** @var Game $game */
        $game = Game::first();

        $this->assertNotNull($game);

        $response
            ->assertJson(
                fn (AssertableJson $json) => $json
                    ->has('data', fn (AssertableJson $json) => $json
                        ->where('id', $game->id)
                        ->where('name', $game->name)
                        ->where('code', $game->code)
                        ->where('master_id', $user->id)
                        ->whereAllType([
                            'id' => 'integer',
                            'name' => 'string',
                            'code' => 'string',
                            'updated_at' => 'string',
                            'created_at' => 'string'
                        ])
                    )
            );
    }

    /**
     * @dataProvider provideBadCreateGameData
     */
    public function test_validated_create_game_data(int $status, array $data): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->postJson(route('api.game.create'), $data);

        $this->assertNull(
            Game::first(),
            'Game was created although it should not be.'
        );

        $response
            ->assertStatus($status)
            ->assertJson(fn (AssertableJson $json) => $json
                ->whereType('errors', 'array')
                ->whereType('message', 'string')
            );
    }

    public static function provideBadCreateGameData(): array
    {
        return [
            [
                422,
                [
                    'name' => null
                ]
            ],
            [
                422,
                [
                    'name' => 999
                ]
            ],
            [
                422,
                [
                    'name' => false
                ]
            ],
            [
                422,
                [
                    'name' => "Dungeons & Dragons, a legendary tabletop RPG, weaves tales of heroes and " .
                    "mythical realms. Players embark on epic quests, facing dragons and unlocking mysteries. " .
                    "It's not just a game; it's a journey where creativity and camaraderie forge unforgettable " .
                    "adventures in a world shaped by imagination."
                ]
            ]
        ];
    }
}
