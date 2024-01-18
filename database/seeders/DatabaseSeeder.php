<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $faker = Faker::create();

        for ($i = 0; $i < 200; $i++) {
            DB::table('blogs')->insert([
                'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'description' => $faker->paragraph($nbSentences = 2, $variableNbSentences = true),
                'content' => $faker->text($maxNbChars = 500),
            ]);
        }
    }
}
