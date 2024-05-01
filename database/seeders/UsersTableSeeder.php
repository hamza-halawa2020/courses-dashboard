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
            'name' => 'hamza halawa',
            'email' => 'hamza@hamza.com',
            'password' => bcrypt('123456'),
            'type' => 'super_admin',
            'phone' => '01149447078',
            'stage_id' => 1,
            'place_id' => 1,
            'parent_phone' => '01151955479',
            'parent_name' => 'mmm'
        ]);

        $user->attachRole('super_admin');


    }//end of run

}//end of seeder
