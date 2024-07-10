<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\AnswerChapter;
use App\Models\AnswerHomeWork;
use App\Models\AnswerLecture;
use App\Models\Banner;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\ExamChapter;
use App\Models\ExamLecture;
use App\Models\Lecture;
use App\Models\Place;
use App\Models\Question;
use App\Models\QuestionHomeWork;
use App\Models\Stage;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Place::factory(3)->create();
        Stage::factory(3)->create();
        $this->call([
            LaratrustSeeder::class,
            UsersTableSeeder::class,
            QRvaluesTableSeeder::class,
        ]);
        // Question::factory(5)->create();
        // Answer::factory(5)->create();
        // Teacher::factory(5)->create();
        // Course::factory(5)->create();
        // Chapter::factory(5)->create();
        // Lecture::factory(5)->create();
        // QuestionHomeWork::factory(5)->create();
        // AnswerHomeWork::factory(5)->create();
        // ExamChapter::factory(5)->create();
        // AnswerChapter::factory(5)->create();
        // ExamLecture::factory(5)->create();
        // AnswerLecture::factory(5)->create();
        // Banner::factory(5)->create();

        // User::factory(5)->create();
    }
}
