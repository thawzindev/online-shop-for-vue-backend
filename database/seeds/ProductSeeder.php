<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));


        foreach (range(1,100) as $index) {
	        DB::table('products')->insert([
	        	'category_id' => rand(1,20),
	        	'seller_id' => rand(5,40),
	            'uuid' => $faker->md5,
	            'product_name' => $faker->productName,
	            'product_image'	=> $faker->imageUrl($width = 640, $height = 480),
	            'department' => $faker->department(3),
	            'promotion_code' => $faker->promotionCode,
	            'description'	=> $faker->text($maxNbChars = 200),
	            'price'	=> 	rand(1000,10000),
	            'stock'	=> rand(10, 100),
	            'in_stock'	=> true,
	        ]);
		}
    }
}
