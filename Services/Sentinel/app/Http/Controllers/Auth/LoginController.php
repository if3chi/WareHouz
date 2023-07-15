<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Guard\Vigilance;
use App\Services\AuthService;
use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\Auth\Factory;
use App\Http\Responses\MessageResponse;
use App\Exceptions\AuthenticationException;
use Illuminate\Contracts\Support\Responsable;

final readonly class LoginController
{
    public function __construct(private Factory $auth, private AuthService $service)
    {
    }

    public function __invoke(LoginRequest $request): Responsable
    {
        return Vigilance::handle(function () use ($request) {
            if (!$this->auth->guard()->attempt($request->only(['email', 'password']))) {
                throw AuthenticationException::inauthentic();
            }

            $token = $this->service->createAccessToken(
                user: $this->auth->guard()->user()
            );

            return new MessageResponse(data: [
                'message' => $token
            ]);
        });
    }
}
