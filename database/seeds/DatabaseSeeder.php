<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       // $this->call(UsersTableSeeder::class);
        
        $this->call(RoleAndPermissionTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(QuestionAnswersSeeder::class);
        $this->call(ArticalSeeder::class);
        $this->call(BookSeeder::class);
    }
}
