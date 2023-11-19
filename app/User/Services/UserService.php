<?php

namespace App\User\Services;

use App\User\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable;

class UserService
{
    public function register(array $data): array
    {
        $user = User::create($data);
        $token = $user->createToken('api_token')->plainTextToken;

        return [
            'user'  => $user,
            'token' => $token,
        ];
    }

    /**
     * @throws Exception
     */
    public function login(array $data): array
    {
        $user = User::firstWhere(['email' => $data['email']]);

        if (!$user || !Hash::check($data['password'], $user->password)) {
            abort(401, 'Bad credentials');
        }

        $token = $user->createToken('api_token')->plainTextToken;

        return [
            'user'  => $user,
            'token' => $token,
        ];
    }

    /** @noinspection PhpPossiblePolymorphicInvocationInspection */
    public function logout(Authenticatable $user): void
    {
        $user->tokens()->delete();
    }
}
