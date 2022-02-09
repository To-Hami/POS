<?php

use Illuminate\Database\Seeder;

class categoriesTableSeeder extends Seeder
{


    public function run()
    {


        $categories = ['Air Condition','Smart Screen','Laptop','Fans','Blender','Water dispenser'];

        foreach ($categories as $category){
            \App\Category::create([
                'name' => $category

            ]);


        }
    }
}
