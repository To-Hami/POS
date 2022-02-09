<?php

use Illuminate\Database\Seeder;

class productTableSeeder extends Seeder
{

    public function run()
    {

        $products = ['Samsung', 'Namsa', 'Elkhaleeg', 'General'];
        $categoryIds = [1, 2, 3, 4];
        foreach ($products as $product) {
            foreach ($categoryIds as $categoryId) {
                \App\Product::create([
                    'category_id' => $categoryId,

                    'name' => $product,
                    'description' => 'description',
                    'purchase_price' => 200,
                    'sale_price' => 500,
                    'stock' => 40
                ]);
            }
        }


    }
}
