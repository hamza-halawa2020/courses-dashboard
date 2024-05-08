<?php


use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\PlaceController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\StageController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {

    //user route
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/change_password', [AuthController::class, 'changePassword']);
    ////===================   Places ============================
    Route::get('/places', [PlaceController::class, 'index']);
    ////===================   Stages ============================
    Route::get('/stages', [StageController::class, 'index']);
    ////===================   questions ============================
    Route::get('/questions', [QuestionController::class, 'index']);
    Route::get('/questions/{id}', [QuestionController::class, 'show']);
    Route::get('/random-question', [QuestionController::class, 'randomQuestion']);

    ////===================   courses ============================
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/courses/{id}', [CourseController::class, 'show']);


});

