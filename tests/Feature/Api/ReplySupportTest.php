<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class ReplySupportTest extends TestCase
{
    use UtilsTrait;

    public function test_create_reply_to_support_unauthenticated()
    {
        $response = $this->postJson('/replies');

        $response->assertStatus(401);
    }


    public function test_create_reply_to_support_error_validations()
    {
        $payload = [];
        $response = $this->postJson('/replies', $payload, $this->defaultHeaders());

        $response->assertStatus(422);
    }

    public function test_create_reply_to_support()
    {
        $support = $this->createSupport();
        $payload = [
            'description' => Str::random(20),
            'support' => $support->id,
        ];
        $response = $this->postJson('/replies', $payload, $this->defaultHeaders());

        $response->assertStatus(201);
    }
}
