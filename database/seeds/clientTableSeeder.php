<?php

use Illuminate\Database\Seeder;

class clientTableSeeder extends Seeder
{

    public function run()
    {
        $clients = ['ahmed','ali','mohamed'];
       foreach ($clients as $client){
           \App\Client::create([
               'name' => $client,
               'phone' => '0995200751',
               'address' =>'myCity'
           ]);
       }
    }
}
