<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        
        $bookIds = DB::table('books')->pluck('id')->toArray();

       
        for ($i = 0; $i < 20; $i++) {
            DB::table('authors')->insert([
                'book_id' => $faker->randomElement($bookIds),
                'stocks' => $faker->numberBetween(0, 100),
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
            ]);
        }
    }
}
