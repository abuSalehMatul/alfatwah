<?php

use App\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
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
                'title' => $faker->text,
                'writer' => $faker->text,
                'status' => "active",
                'language' => $faker->randomElement(['en', 'bn', 'ar']),
                'link' => 'http://alfatwat.book.com',
                'created_at' => now()
            ];
            Book::insert($data);
        }
    }
}
