<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Data\LoginData;
use Illuminate\Http\JsonResponse;

class LoginService
{
    public function login(LoginData $data): JsonResponse
    {
        $credentials = array_filter($data->toArray());

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }

    private function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
