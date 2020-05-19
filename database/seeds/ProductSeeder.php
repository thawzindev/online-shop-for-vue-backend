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
        $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));

        foreach (range(1,200) as $index) {
	        DB::table('products')->insert([
	        	'category_id' => rand(1,20),
	        	'seller_id' => rand(5,40),
	            'uuid' => $faker->md5,
	            'product_name' => $faker->fruitName,
	            'product_image'	=> 'https://i5.walmartimages.ca/images/Enlarge/094/514/6000200094514.jpg',
	            'department' => $faker->department(3),
	            'promotion_code' => $faker->promotionCode,
	            'description'	=> $faker->text($maxNbChars = 250),
	            'price'	=> 	rand(100,1000),
	            'stock'	=> rand(10, 100),
	            'in_stock'	=> true,
	            'created_at'	=> date("Y-m-d H:i:s"),
	        ]);
		}
    }
}
