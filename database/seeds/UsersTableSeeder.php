<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        $user = \App\User::create([
            'first_name' => 'super',
            'last_name' => 'admin',
            'email' => 'super_admin@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        $user->attachRole('super_admin');

    }//end of run
}
