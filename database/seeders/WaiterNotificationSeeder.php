<?php

namespace Database\Seeders;

use App\Models\WaiterNotification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class WaiterNotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(1, 20) as $index) {
           WaiterNotification::create([
               'table_name' => "Bàn ".$faker->numberBetween(0, 9),
                'notification_status' => $faker->randomElement(['Clean', 'Cooking', 'Done']), 
                'food_name' => "Food ".$faker->numberBetween(1, 5), 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
