<?php

namespace App\Character\Http\Api\Controllers;

use Illuminate\Http\JsonResponse;
use App\Common\Http\Controllers\Controller;
use App\Character\Services\CharacterService;

class CharacterController extends Controller
{
    public function __construct(private readonly CharacterService $characterService) {}

    public function show(mixed $id): JsonResponse
    {
        $character = $this->characterService->find($id);

        return response()->json([
            'data' => $character
        ]);
    }
}
