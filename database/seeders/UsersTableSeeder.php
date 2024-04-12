<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'super_admin',
            'email' => 'super_admin@app.com',
            'password' => bcrypt('password'),
            'type' => 'super_admin',
            'phone' => '01151997479',
            'stage_id'=>1,
            'place_id'=>1,
            'parent_phone'=>'01151955479',
            'parent_name'=>'mmmm'
        ]);

        $user->attachRole('super_admin');

    }//end of run

}//end of seeder
