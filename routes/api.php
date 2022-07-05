<?php

use App\Http\Controllers\Api\{
    CourseController,
    ModuleController,
    LessonController,
    ReplySupportController,
    SupportController,
};
use App\Http\Controllers\Api\Auth\{
    AuthController,
    ResetPasswordController
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Auth
 */
Route::post('/auth', [AuthController::class, 'auth']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

/**
 * Reset Password
 */
Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLink'])->middleware('guest');


/**
 * Routes
 */
Route::middleware(['auth:sanctum'])->group(function(){
    #Courses
    Route::get('/courses', [CourseController::class, 'index'])->name('course.index');
    Route::get('/courses/{id}', [CourseController::class, 'show'])->name('course.show');
    Route::get('/courses/{id}/modules', [ModuleController::class, 'index']);
    #Modules
    Route::get('/modules/{id}/lessons', [LessonController::class, 'index']);
    Route::get('/lessons/{id}', [LessonController::class,'show']);
    #Support
    Route::get('/my-supports', [SupportController::class, 'mySupports']);
    Route::get('/supports', [SupportController::class, 'index']);
    Route::post('/supports', [SupportController::class, 'store']);
    Route::post('/replies', [ReplySupportController::class, 'createReply']);
});