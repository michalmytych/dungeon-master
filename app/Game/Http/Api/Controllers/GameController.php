<?php

namespace App\Game\Http\Api\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Game\Services\GameService;
use App\Common\Http\Controllers\Controller;
use App\Game\Http\Api\Requests\JoinRequest;
use App\Game\Http\Api\Requests\CreateRequest;
use App\Common\Exceptions\DungeonMasterException;

class GameController extends Controller
{
    public function __construct(private readonly GameService $gameService)
    {
    }

    public function join(JoinRequest $createRequest, string $code): JsonResponse
    {
        try {
            $character = $this->gameService->join(
                $code,
                $createRequest->user()
            );

        } catch (DungeonMasterException $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], $exception->getHttpErrorStatusCode());
        }

        return response()->json([
            'data' => $character
        ]);
    }

    /**
     * @throws Exception
     */
    public function create(CreateRequest $createRequest): JsonResponse
    {
        $game = $this->gameService->create(
            $createRequest->validated(),
            $createRequest->user()
        );

        return response()->json([
            'data' => $game
        ], 201);
    }
}
