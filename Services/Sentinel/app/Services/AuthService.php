<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\DatabaseManager;

final readonly class AuthService
{
    public function __construct(private DatabaseManager $manager)
    {
    }

    public function createUser(array $data): User|Model
    {
        return $this->manager->transaction(
            callback: fn () => User::query()->create($data),
            attempts: 2
        );
    }

    public function createAccessToken(User $user): string
    {
        $token =  Str::random(40);

        Cache::put(
            key: $token,
            value: [
                'id' => $user->getKey(),
                'role' => $user->getAttribute('role')
            ],
            ttl: now()->addHours(2)
        );

        return $token;
    }
}
