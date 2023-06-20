<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Enums\Status;
use App\Http\Requests\LoginRequest;
use App\Services\AccessTokenService;
use Illuminate\Contracts\Auth\Factory;
use App\Http\Responses\MessageResponse;
use App\Exceptions\AuthenticationException;
use Illuminate\Contracts\Support\Responsable;

final readonly class LoginController
{
    public function __construct(private Factory $auth, private AccessTokenService $service)
    {
    }

    public function __invoke(LoginRequest $request): Responsable
    {
        if (!$this->auth->guard()->attempt($request->only(['email', 'password']))) {
            throw new AuthenticationException(
                message: 'Invalid Credentials',
                code: Status::UNPROCESSABLE_CONTENT->value
            );
        }

        $token = $this->service->create(
            user: $this->auth->guard()->user()
        );

        return new MessageResponse(data: [
            'token' => $token
        ]);
    }
}
