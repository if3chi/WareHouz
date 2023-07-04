<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Enums\Status;
use Illuminate\Testing\TestResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

final class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_validates_user_input(): void
    {
        $response = $this->postJson('login', data: []);

        $response->assertStatus(Status::UNPROCESSABLE_CONTENT->value);
        $response->assertJsonValidationErrorFor('email');
        $response->assertJsonValidationErrorFor('password');
    }

    public function test_returns_ok_status_if_credentials_are_correct(): void
    {
        $response = $this->login();

        $response->assertStatus(Status::OK->value);
    }

    public function test_it_stores_token_in_cache(): void
    {
        $response = $this->login();
        $token = Cache::get($response->json('token'));

        $response->assertStatus(Status::OK->value);
        $this->assertIsArray($token);
        $this->assertNotEquals($token, null);

    }

    private function login(): TestResponse
    {
        $user = User::factory()->create();

        return $this->postJson('login', data: [
            'email' => $user->email,
            'password' => 'password',
        ]);
    }
}
