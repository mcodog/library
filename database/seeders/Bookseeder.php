<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) { 
            DB::table('books')->insert([
                'author_id' => $faker->randomElement(array (1,2,3,4,5)),
                'title' => $faker->sentence(),
                'imgpath' => $faker->imageUrl(),
                'date_released' => $faker->date(),
                'nums' => $faker->numberBetween(1, 100),
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
                'genre_id' => $faker->numberBetween(1, 10),// remove this line if you don't want to set the column to null
            ]);
        }
    }
}
