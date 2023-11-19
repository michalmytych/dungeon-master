<?php

namespace App\User\Http\Api\Controllers;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User\Services\UserService;
use App\Common\Http\Controllers\Controller;
use App\User\Http\Api\Requests\LoginRequest;
use App\User\Http\Api\Requests\RegisterRequest;

class UserController extends Controller
{
    public function __construct(private readonly UserService $userService) {}

    public function register(RegisterRequest $request): Response
    {
        $result = $this->userService->register(
            $request->validated()
        );

        return response($result, 201);
    }

    public function login(LoginRequest $request): Response
    {
        try {
            $result = $this->userService->login(
                $request->validated()
            );

        } catch (Throwable) {
            return response([
                'message' => 'Bad credentials provided!',
            ], 401);
        }

        return response($result);
    }

    public function logout(Request $request): Response
    {
        $this->userService->logout($request->user());

        return response([
            'message' => 'User logged out successfully.',
        ]);
    }

    public function user(Request $request): Response
    {
        return response([
            'user'  => $request->user(),
            'token' => $request->bearerToken(),
        ]);
    }
}
