<?php

use App\Article;
use Illuminate\Database\Seeder;

class ArticalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i = 0; $i < 20; $i++){
            $data = [
                'category_id' => rand(1, 4),
                'title' => $faker->text,
                'slug' => $faker->text,
                'status' => "active",
                'language' => $faker->randomElement(['en', 'bn', 'ar']),
                'body' => $faker->sentence(25, true),
                'created_at' => now()
            ];
            Article::insert($data);
        }
    }
}
