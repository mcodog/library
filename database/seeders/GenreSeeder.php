<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class GenreSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        
        $faker = Faker::create();
        foreach(range(1, 10) as $index) { 
            DB::table('genres')->insert([
                'genre_name' => $faker->word(),
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime() 
            ]);
        }
    }
}
