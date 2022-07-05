<?php

namespace Tests\Feature\Api;

use App\Models\Module;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ModuleTest extends TestCase
{
    use UtilsTrait;

    public function test_get_modules_unauthenticated()
    {
        $response = $this->getJson('/courses/fake_value/modules');

        $response->assertStatus(401);
    }

    public function test_get_modules_course_not_found()
    {
        $response = $this->getJson('/courses/fake_value/modules', $this->defaultHeaders());

        $response->assertStatus(404);
    }

    public function test_get_modules_course()
    {
        $course = $this->createCourse();
        $response = $this->getJson("/courses/{$course->id}/modules", $this->defaultHeaders());

        $response->assertStatus(200);
    }

    public function test_get_modules_course_total()
    {
        $course = $this->createCourse();
        Module::factory()->count(10)->create([
            'course_id' => $course->id
        ]);

        $response = $this->getJson("/courses/{$course->id}/modules", $this->defaultHeaders());
        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }
}
