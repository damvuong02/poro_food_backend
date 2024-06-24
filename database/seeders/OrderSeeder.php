<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Nette\Utils\Random;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        foreach (range(1, 20) as $index) {
           Order::create([
                'food_id' => $faker->numberBetween(1, 10), // Assuming 10 different food items
                'quantity' => $faker->numberBetween(1, 5), // Random quantity between 1 and 5
                'price' => $faker->numberBetween(10000, 200000), // Random price between 5 and 20
                'table_name' => "Bàn ".$faker->numberBetween(0, 9), // Random table name
                'order_status' => $faker->randomElement(['New', 'Cooking', 'Done']), 
                'note' => "ss", // Random note
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
