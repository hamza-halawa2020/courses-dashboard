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
use App\Models\QusetionHomeWork;
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
        Question::factory(10)->create();
        Answer::factory(30)->create();
        Teacher::factory(5)->create();
        Course::factory(5)->create();
        Chapter::factory(5)->create();
        Lecture::factory(40)->create();
        QusetionHomeWork::factory(10)->create();
        AnswerHomeWork::factory(30)->create();
        ExamChapter::factory(30)->create();
        AnswerChapter::factory(30)->create();
        ExamLecture::factory(30)->create();
        AnswerLecture::factory(30)->create();
        Banner::factory(5)->create();

        User::factory(10)->create();
    }
}
