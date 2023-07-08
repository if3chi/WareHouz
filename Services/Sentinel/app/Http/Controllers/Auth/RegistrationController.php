<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Enums\Status;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use App\Http\Responses\MessageResponse;
use App\Http\Requests\RegistrationRequest;
use App\Exceptions\AuthenticationException;
use Illuminate\Contracts\Support\Responsable;

final readonly class RegistrationController
{
    public function __construct(private AuthService $authService)
    {
    }

    public function __invoke(RegistrationRequest $request): JsonResponse
    {
        try {
            $user = $this->authService->createUser([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make(value: $request->password)
            ]);

            return response()->json(data: [
                'message' => $this->authService->createAccessToken($user)
            ], status: Status::CREATED->value);
        } catch (\Throwable $e) {
            throw new AuthenticationException(
                message: 'Failed to create user account',
                code: Status::INTERNAL_SERVER_ERROR->value,
                previous: $e
            );
        }
    }
}
