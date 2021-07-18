<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	$app_name = Str::slug(env('APP_NAME', "Al Fatwah"), '');
        foreach (config('enums.roles') as $role) {
        	$user = User::create([
        		'name' => $role,
        		'email' => "{$role}@{$app_name}.com",
        		'password' => Hash::make('password')
        	]);
        	$user->assignRole($role);
        }
    }
}
