<?php

namespace App\Game\Http\Api\Controllers;

use App\Game\Exceptions\GameNotFoundException;
use App\Game\Exceptions\UserAlreadyJoinedGameException;
use App\Game\Http\Api\Requests\JoinRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Game\Services\GameService;
use App\Common\Http\Controllers\Controller;
use App\Game\Http\Api\Requests\CreateRequest;

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

        } catch (GameNotFoundException $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], 404);

        } catch (UserAlreadyJoinedGameException $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], 400);
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
