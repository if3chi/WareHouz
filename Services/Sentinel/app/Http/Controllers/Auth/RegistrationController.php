<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Enums\Status;
use App\Exceptions\AuthenticationException;
use App\Http\Requests\RegistrationRequest;
use App\Http\Responses\MessageResponse;
use App\Services\AuthService;
use Illuminate\Support\Facades\Hash;

final readonly class RegistrationController
{
    public function __construct(private AuthService $authService)
    {
    }

    public function __invoke(RegistrationRequest $request)
    {
        try {
            $user = $this->authService->createUser([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make(value: $request->password)
            ]);

            return new MessageResponse(data: [
                'token' => $this->authService->createAccessToken($user)
            ], status: Status::CREATED);
        } catch (\Throwable $e) {
            throw new AuthenticationException(
                message: 'Failed to create user account',
                code: Status::INTERNAL_SERVER_ERROR->value,
                previous: $e
            );
        }
    }
}
