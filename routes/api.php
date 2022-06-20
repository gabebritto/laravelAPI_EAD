<?php

use App\Http\Controllers\Api\{
   CourseController,
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
Route::get('/courses', [CourseController::class, 'index'])->name('course.index');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('course.show');


Route::get('/', function() {
    return response()->json(['Success' => true]);
});
