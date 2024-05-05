<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i=0; $i < 15; $i++) { 
            Account::create([
                'user_name'=>$faker->userName(),
                'password'=>$faker->password(),
                'name'=>$faker->name(),
                'roll'=>$faker->randomElement(['Đầu bếp', 'Quản lý', 'Thu ngân', 'Phục vụ']),
            ]);
        }
    }
}
