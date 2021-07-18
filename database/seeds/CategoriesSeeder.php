<?php

use Illuminate\Database\Seeder;

use App\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = config('categories');
        foreach ($categories as $key => $category) {
        	Category::create($category);
        }
    }
}
