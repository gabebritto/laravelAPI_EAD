<?php

namespace App\Repositories;

use App\Models\Lesson;
use App\Models\Module;
use App\Models\View;
use App\Repositories\Traits\RepositoryTrait;

class LessonRepository
{
    use RepositoryTrait;

    protected $entity;

    public function __construct(Lesson $model)
    {
        $this->entity = $model;
    }

    public function getLessonsByModuleId(string $moduleId)
    {
        if(Module::findOrFail($moduleId)){
            return $this->entity
                                ->where('module_id', $moduleId)
                                ->with('supports.replies')
                                ->get();
        }
    }

    public function getLesson(string $id)
    {
        return $this->entity->findOrFail($id);
    }

    public function markLessonViewed(string $lessonId)
    {
        $user = $this->getUserAuth();

        $view = $user->views()->where('lesson_id', $lessonId)->first();

        if($view){
            return $view->update([
                'qty' => $view->qty + 1
            ]);
        }

        return $user->views()->create([
            'lesson_id' => $lessonId
        ]);
    }
}