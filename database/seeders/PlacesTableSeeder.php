<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Stage;
use App\Models\Place;
use Illuminate\Database\Seeder;

class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $places = [
            ['name' => 'super_admin'],
            ['name' => 'سنتر البيان'],
            ['name' => 'سنتر النور'],
            ['name' => 'سنتر شباب الامه']
        ];

        foreach ($places as $place) {

            Place::create($place);

        }//end of for each


    }//end of run

}//end of seeder
