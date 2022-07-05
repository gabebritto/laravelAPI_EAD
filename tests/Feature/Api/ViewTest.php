<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    use UtilsTrait;

    public function test_make_viewed_unauthenticated()
    {
        $response = $this->postJson('/lessons/viewed');

        $response->assertStatus(401);
    }

    public function test_make_viewed_not_found()
    {
        $payload = [];
        $response = $this->postJson('/lessons/viewed', $payload, $this->defaultHeaders());
        $response->assertStatus(422);
    }

    public function test_make_viewed_invalid_lesson()
    {
        $payload = ['lesson' => 'fake_lesson'];
        $response = $this->postJson('/lessons/viewed', $payload, $this->defaultHeaders());
        $response->assertStatus(422);
    }

    public function test_make_viewed()
    {
        $lesson = $this->createLesson();
        $payload = [
            'lesson' => "$lesson->id"
        ];
        $response = $this->postJson('/lessons/viewed', $payload, $this->defaultHeaders());
        $response->assertStatus(200);
    }

}
