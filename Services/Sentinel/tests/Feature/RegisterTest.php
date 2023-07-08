<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Enums\Status;
use Illuminate\Testing\TestResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    private $url = 'register';

    public function test_validates_user_input(): void
    {
        $response = $this->postJson($this->url, data: []);

        $response->assertStatus(Status::UNPROCESSABLE_CONTENT->value);
        $response->assertJsonValidationErrorFor('name');
        $response->assertJsonValidationErrorFor('email');
        $response->assertJsonValidationErrorFor('password');
    }

    public function test_creates_new_user_record(): void
    {
        $this->assertEquals(User::query()->count(), 0);

        $response = $this->register();

        $this->assertEquals(User::query()->count(), 1);
    }

    public function test_it_stores_token_in_cache(): void
    {
        $response = $this->register();
        $token = Cache::get($response->json('message'));

        $this->assertIsArray($token);
        $this->assertNotEquals($token, null);
    }

    public function register(): TestResponse
    {
        $response = $this->postJson($this->url, data: [
            'name' => 'Test User',
            'email' => 'test@sentinel.com',
            'password' => 'passwordF'
        ]);

        $response->assertStatus(Status::CREATED->value);

        return $response;
    }
}
