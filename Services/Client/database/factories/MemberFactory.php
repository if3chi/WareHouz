<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Role;
use App\Models\Client;
use App\Models\Member;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

final class MemberFactory extends Factory
{
    protected $model = Member::class;

    public function definition(): array
    {
        return [
            'role' => Role::USER,
            'client' => Client::factory(),
            'company' => Company::factory(),
        ];
    }

    public function role(Role $role): MemberFactory
    {
        return $this->state(
            state: static fn ($attributes): array => ['role' => $role]
        );
    }
}
