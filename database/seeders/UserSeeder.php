<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i=0; $i < 15; $i++) { 
            User::create([
                'user_name'=>$faker->userName(),
                'password'=>$faker->password(),
                'name'=>$faker->name(),
                'roll'=>$faker->randomElement(['Đầu bếp', 'Quản lý', 'Thu ngân', 'Phục vụ'])
            ]);
        }
    }
}
