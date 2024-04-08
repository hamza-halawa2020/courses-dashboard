<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Stage;
use Illuminate\Database\Seeder;

class StagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stages = [
            ['name' => 'اولي ثانوي '],
            ['name' => 'تانيه تانوي'],
            ['name' => 'تالته ثانوي']
        ];

        foreach ($stages as $stage) {

            Stage::create($stage);


        }//end of for each


    }//end of run

}//end of seeder
