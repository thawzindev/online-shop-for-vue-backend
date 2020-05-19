<?php

use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
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
	        DB::table('blogs')->insert([
	            'title' => $faker->foodName,
	            'image'	=> 'https://i5.walmartimages.ca/images/Enlarge/094/514/6000200094514.jpg',
	            'body'	=> $faker->text($maxNbChars = 500),
	            'is_feature'	=> 	rand(1,2),
	            'status'	=> rand(1, 2),
	            'category_id'	=> rand(1, 15),
	            'created_at'	=> date("Y-m-d H:i:s"),
	        ]);
		}
    }
}
