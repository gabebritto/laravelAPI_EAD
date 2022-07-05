<?php

namespace Tests\Feature\Api;

use App\Models\Support;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class SupportTest extends TestCase
{
    use UtilsTrait;

    public function test_get_my_supports_unauthenticated()
    {
        $response = $this->getJson('/my-supports');
        $response->assertStatus(401);
    }

    public function test_get_my_supports()
    {
        $user = $this->createUser();
        $token = $user->createToken('teste')->plainTextToken;
        Support::factory()->count(50)->create([
            'user_id' => $user->id,
        ]);
        $response = $this->getJson('/my-supports', [
            'Authorization' => "Bearer {$token}"
        ]);
        $response->assertStatus(200)->assertJsonCount(50, 'data');
    }

    public function test_get_supports_unauthenticated()
    {
        $response = $this->getJson('/supports');
        $response->assertStatus(401);
    }

    public function test_get_supports()
    {
        Support::factory()->count(50)->create();
        $response = $this->getJson('/supports', $this->defaultHeaders());
        $response->assertStatus(200)->assertJsonCount(50, 'data');
    }

    public function test_get_supports_filter_lesson()
    {
        $lesson = $this->createLesson();
        Support::factory()->count(50)->create();
        Support::factory()->count(10)->create([
            'lesson_id' => $lesson->id,
        ]);
        $payload = [
            'lesson' => $lesson->id
        ];
        $response = $this->Json('GET', '/supports', $payload, $this->defaultHeaders());
        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }

    public function test_create_support_unauthenticated()
    {
        $response = $this->postJson('/supports');
        $response->assertStatus(401);
    }

    public function test_create_support_error_validations()
    {
        $response = $this->postJson('/supports',[], $this->defaultHeaders());
        $response->assertStatus(422);
    }

    public function test_create_support()
    {
        $lesson = $this->createLesson();
        $payload = [
            'lesson' => $lesson->id,
            'status' => 'P',
            'description' => Str::random(15)
        ];
        $response = $this->postJson('/supports', $payload, $this->defaultHeaders());
        $response->assertStatus(201);
    }

}
