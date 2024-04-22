<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\QRvalue;
use Illuminate\Database\Seeder;

class QRvaluesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            ['tittle' => 'فئة ال 50','value'=>'50'],
            ['tittle' => 'فئة ال 100','value'=>'100'],
            ['tittle' => 'فئة ال 150','value'=>'150'],
            ['tittle' => 'فئة ال 200','value'=>'200'],
            ['tittle' => 'فئة ال 250','value'=>'250'],
        ];

        foreach ($cities as $city) {

            QRvalue::create($city);

        }//end of for each


    }//end of run

}//end of seeder
