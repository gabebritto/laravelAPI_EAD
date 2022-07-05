<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Support;
use App\Models\User;

trait UtilsTrait
{
    public function createUser() :User
    {
        $user = User::factory()->create();
        return $user;
    }

    public function createTokenUser()
    {
        $user = $this->createUser();
        $token = $user->createToken('teste')->plainTextToken;
        return $token;
    }

    public function defaultHeaders()
    {
        $token = $this->createTokenUser();
        
        return [
            'Authorization' => "Bearer {$token}",
        ];
    }

    public function createCourse(): Course
    {
        return Course::factory()->create();
    }

    public function create10Courses()
    {
        return Course::factory()->count(10)->create();
    }

    public function createModule(): Module
    {
        return Module::factory()->create();
    }

    public function createLesson(): Lesson
    {
        return Lesson::factory()->create();
    }

    public function createSupport(): Support
    {
        return Support::factory()->create();
    }
}