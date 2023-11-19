<?php

namespace Tests\Feature\User;

use App\Character\Models\Character;
use Tests\TestCase;
use App\User\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CharacterTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_character(): void
    {
        /** @var Character $character */
        $character = Character::factory()->create();

        /** @var User $user */
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->getJson(route('api.character.show', ['id' => $character->id]))
            ->assertOk()
            ->assertJson(
                fn (AssertableJson $json) => $json
                    ->has('data', fn (AssertableJson $json) => $json
                        ->where('id', $character->id)
                        ->where('name', $character->name)
                        ->whereAllType([
                            'id' => 'integer',
                            'name' => 'string',
                            'updated_at' => 'string',
                            'created_at' => 'string'
                        ])
                    )
            );
    }
}
