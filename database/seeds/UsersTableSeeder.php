<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
    
        Model::unguard();
        
        for ($i = 0; $i < 50; $i++)
        {
            $user = [
                'name'      =>  $faker->name,
                'email'     =>  $faker->email,
                'password'  =>  Hash::make('some_secret_pass'),
            ];
    
            User::create($user);
        }
        
        Model::reguard();
    }
}
