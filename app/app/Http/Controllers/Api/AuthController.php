<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Services\LoginService;
use Illuminate\Http\JsonResponse;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\Response;

#[Group('Auth')]
class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    #[Endpoint('Login', 'Authorize user')]
    #[Response(
        '{
            "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vdGltZXRyYWNrZXItYmFja2VuZC5sb2NhbGhvc3Q6ODAwMy9hcGkvdjEvYXV0aC9sb2dpbiIsImlhdCI6MTcwODUzMTc1OCwiZXhwIjoxNzA4NTM1MzU4LCJuYmYiOjE3MDg1MzE3NTgsImp0aSI6ImYyQzQ5Wnp5U0xKWGFwR24iLCJzdWIiOiIyMiIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.CAbPEf7Uj6LhXw1OkVIRpLsZ2993KdkrbYKiEIa5gE8",
            "token_type": "bearer",
            "expires_in": 3600
        }',
        200,
        "success"
    )]
    #[Response(
        '{
            "error" => "Unauthorized"
        }',
        401,
        "Fail"
    )]
    public function login(LoginRequest $request, LoginService $service): JsonResponse
    {
        return $service->login($request->dto());
    }

    #[Endpoint('Login', 'Return user data')]
    #[Response(
        '{
            "id": 22,
            "name": "TMsZnKofrX",
            "email": "testtest@test.com",
            "username": "testtest",
        }',
        200,
        "success"
    )]
    #[Response(
        '{
            "error" => "Unauthorized"
        }',
        401,
        "Fail"
    )]
    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    #[Endpoint('Login', 'Return user data')]
    #[Response(
        '{
            "message" => "Successfully logged out"
        }',
        200,
        "success"
    )]
    #[Response(
        '{
            "error" => "Unauthorized"
        }',
        401,
        "Fail"
    )]
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    #[Endpoint('Login', 'Return user data')]
    #[Response(
        '{
            "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vdGltZXRyYWNrZXItYmFja2VuZC5sb2NhbGhvc3Q6ODAwMy9hcGkvdjEvYXV0aC9sb2dpbiIsImlhdCI6MTcwODUzMTc1OCwiZXhwIjoxNzA4NTM1MzU4LCJuYmYiOjE3MDg1MzE3NTgsImp0aSI6ImYyQzQ5Wnp5U0xKWGFwR24iLCJzdWIiOiIyMiIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.CAbPEf7Uj6LhXw1OkVIRpLsZ2993KdkrbYKiEIa5gE8",
            "token_type": "bearer",
            "expires_in": 3600
        }',
        200,
        "success"
    )]
    #[Response(
        '{
            "error" => "Unauthorized"
        }',
        401,
        "Fail"
    )]
    public function refresh(LoginService $service): JsonResponse
    {
        return $service->refresh();
    }
}
