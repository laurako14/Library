<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'lape',
            'email' => 'lape@gmail.com',
            'password' => Hash::make('123'),
        ]);

        $faker = Faker::create();
        $authors = 10;
        $publishers = 10;
        $genres = 10;
        $books = 150;

        foreach(range(1, $authors) as $_) {
        DB::table('authors')->insert([
            'name' => $faker->firstName(),
            'surname' => $faker->lastName(),
        ]);
    }

    foreach(range(1, $publishers) as $_) {
        DB::table('publishers')->insert([
            'name' => $faker->company(),
        ]);
    }

    foreach(range(1, $genres) as $_) {
        DB::table('genres')->insert([
            'name' => $faker->realText(24),
        ]);
    }

    foreach(range(1, $books) as $_) {
        DB::table('books')->insert([
            'title' => $faker->realText(25),
            'isbn' => $faker->isbn13(),
            'pages' => rand(50, 650),
            'about' => $faker->paragraph($nbSentences = 2, $variableNbSentences = true),
            'author_id' => rand(1, $authors),
            'publisher_id' => rand(1, $publishers),
            'genre_id' => rand(1, $genres),
        ]);
    }

    }
}
