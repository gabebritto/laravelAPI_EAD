<?php

namespace App\Repositories;

use App\Models\Course;
use App\Models\Module;
use PhpParser\Node\Expr\FuncCall;

class ModuleRepository
{
    protected $entity;

    public function __construct(Module $model)
    {
        $this->entity = $model;
    }
    
    public function getModulesByCourseId(string $courseId)
    {
        if(Course::findOrFail($courseId))
        {
            return $this->entity->where('course_id', $courseId)->get();
        }
    }
}