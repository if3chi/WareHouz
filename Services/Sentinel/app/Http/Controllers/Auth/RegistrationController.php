<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Enums\Status;
use App\Guard\Vigilance;
use App\Services\AuthService;
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

    public function __invoke(RegistrationRequest $request): Responsable
    {
        return Vigilance::handle(
            callback: function () use ($request): Responsable {
                $user = $this->authService->createUser([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make(value: $request->password)
                ]);

                return new MessageResponse(data: [
                    'token' => $this->authService->createAccessToken($user)
                ], status: Status::CREATED);
            },
            throwable: AuthenticationException::accountBotched()
        );
    }
}
