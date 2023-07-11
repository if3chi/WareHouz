<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;
use App\Exceptions\AuthenticationException;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

final class ClientsTest extends TestCase
{
    private string $url = 'clients/';

    public function test_throws_authentication_exception_if_not_authnticated(): void
    {
        $response = $this->getJson($this->url);

        $response->assertStatus(401);
        $this->expectException(AuthenticationException::class);
    }
}
