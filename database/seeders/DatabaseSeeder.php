<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Banner;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Question;
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
        $this->call([
            LaratrustSeeder::class,
            PlacesTableSeeder::class,
            StagesTableSeeder::class,
            UsersTableSeeder::class,
            QRvaluesTableSeeder::class,
        ]);
        Question::factory(10)->create();
        Answer::factory(30)->create();
        Banner::factory(5)->create();
        Course::factory(5)->create();
        Chapter::factory(15)->create();

    }
}
