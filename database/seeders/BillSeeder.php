<?php

namespace Database\Seeders;

use App\Models\Bill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            Bill::create([
                'account_id' => $faker->numberBetween(1, 10), // Assuming 10 accounts exist
                'bill_detail' => $faker->paragraph(),
                'table_name' => $faker->randomElement(['Bàn 1', 'Bàn 2', 'Bàn 3', 'Bàn 4', 'Bàn 5', 'Bàn 6', 'Bàn 7']),
            ]);
        }
    }
}
