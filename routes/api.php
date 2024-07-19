<?php


use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BalanceController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\ChapterController;
use App\Http\Controllers\Api\ConvertPointToBalanceController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\LectureController;
use App\Http\Controllers\Api\PlaceController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\StageController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Api\TestingExamLectureContoller;
use App\Http\Controllers\Api\TestingQuestionController;
use App\Http\Controllers\Api\TestingQuestionHomeWorkContoller;
use App\Http\Controllers\Api\TestingTotalExamController;
use Illuminate\Support\Facades\Route;


////=================== users ============================
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

////=================== banners ============================
Route::get('/banners', [BannerController::class, 'index']);
Route::get('/banners/{id}', [BannerController::class, 'show']);

////=================== Places ============================
Route::get('/places', [PlaceController::class, 'index']);

////=================== Stages ============================
Route::get('/stages', [StageController::class, 'index']);


////=================== sanctum ============================

Route::middleware('auth:sanctum')->group(function () {

    ////=================== users ============================
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/change_password', [AuthController::class, 'changePassword']);
    Route::post('/profile', [AuthController::class, 'updateUser']);
    Route::post('/logout', [AuthController::class, 'logout']);


    ////=================== questions ============================
    Route::get('/questions', [QuestionController::class, 'index']);
    Route::get('/questions/{id}', [QuestionController::class, 'show']);
    Route::get('/random-question', [QuestionController::class, 'randomQuestion']);

    ////=================== teachers ============================
    Route::get('/teachers', [TeacherController::class, 'index']);
    Route::get('/teachers/{id}', [TeacherController::class, 'show']);
    ////=================== courses ============================
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/courses/{id}', [CourseController::class, 'show']);

    ////=================== chapters ============================
    Route::get('/chapters', [ChapterController::class, 'index']);
    Route::get('/chapters/{id}', [ChapterController::class, 'show']);
    Route::post('/chapters/{id}/buy', [ChapterController::class, 'buyChapter']);

    ////=================== lectures ============================
    Route::get('/lectures', [LectureController::class, 'index']);
    Route::get('/lectures/{id}', [LectureController::class, 'show']);
    Route::post('/lectures/{id}/buy', [LectureController::class, 'buyLecture']);

    ////=================== balance ============================
    Route::get('/balances', [BalanceController::class, 'index']);
    Route::get('/balances/{id}', [BalanceController::class, 'show']);
    Route::post('/balances', [BalanceController::class, 'addBalanceByQrCode']);

    ////=================== testing questions ============================
    Route::get('/testing_questions', [TestingQuestionController::class, 'index']);
    Route::get('/testing_questions/{id}', [TestingQuestionController::class, 'show']);
    Route::post('/testing_questions', [TestingQuestionController::class, 'store']);
    ////=================== testing exam_lecture ============================
    Route::get('/testing_total_exam', [TestingTotalExamController::class, 'index']);
    Route::get('/testing_total_exam/{id}', [TestingTotalExamController::class, 'show']);
    Route::post('/testing_total_exam', [TestingTotalExamController::class, 'store']);

    ////=================== testing questions_home_work ============================
    Route::get('/testing_questions_home_work', [TestingQuestionHomeWorkContoller::class, 'index']);
    Route::get('/testing_questions_home_work/{id}', [TestingQuestionHomeWorkContoller::class, 'show']);
    Route::post('/testing_questions_home_work', [TestingQuestionHomeWorkContoller::class, 'store']);
    ////=================== testing exam_lecture ============================
    Route::get('/testing_exam_lecture', [TestingExamLectureContoller::class, 'index']);
    Route::get('/testing_exam_lecture/{id}', [TestingExamLectureContoller::class, 'show']);
    Route::post('/testing_exam_lecture', [TestingExamLectureContoller::class, 'store']);
    ////=================== convert points ==============================

    Route::post('/convert-points', [ConvertPointToBalanceController::class, 'convert']);

});

