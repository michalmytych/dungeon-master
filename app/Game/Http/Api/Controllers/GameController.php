<?php

namespace App\Game\Http\Api\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Game\Services\GameService;
use App\Common\Http\Controllers\Controller;
use App\Game\Http\Api\Requests\CreateRequest;

class GameController extends Controller
{
    public function __construct(private readonly GameService $gameService) {}

    /**
     * @throws Exception
     */
    public function create(CreateRequest $createRequest): JsonResponse
    {
        $game = $this->gameService->create($createRequest->validated());

        return response()->json([
            'data' => $game
        ], 201);
    }
}
