<?php


use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BalanceController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\ChapterController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\LectureController;
use App\Http\Controllers\Api\PlaceController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\StageController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

////=================== banner ============================
Route::get('/banners', [BannerController::class, 'index']);
Route::get('/banners/{id}', [BannerController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {

    //user route
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/change_password', [AuthController::class, 'changePassword']);

    ////=================== questions ============================
    Route::get('/questions', [QuestionController::class, 'index']);
    Route::get('/questions/{id}', [QuestionController::class, 'show']);
    Route::get('/random-question', [QuestionController::class, 'randomQuestion']);

    ////=================== courses ============================
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/courses/{id}', [CourseController::class, 'show']);

    ////=================== chapters ============================
    Route::get('/chapters', [ChapterController::class, 'index']);
    Route::get('/chapters/{id}', [ChapterController::class, 'show']);

    ////=================== lectures ============================
    Route::get('/lectures', [LectureController::class, 'index']);
    Route::get('/lectures/{id}', [LectureController::class, 'show']);

    ////=================== balance ============================
    Route::get('/balances', [BalanceController::class, 'index']);
    Route::get('/balances/{id}', [BalanceController::class, 'show']);
    Route::post('/balances', [BalanceController::class, 'addBalanceByQrCode']);





});

////=================== Places ============================
Route::get('/places', [PlaceController::class, 'index']);

////=================== Stages ============================
Route::get('/stages', [StageController::class, 'index']);
