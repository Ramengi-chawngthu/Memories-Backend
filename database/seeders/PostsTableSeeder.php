<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Posts;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { {
            // Let's truncate our existing records to start from scratch.
            // Posts::truncate();

            $faker = \Faker\Factory::create();

            // And now, let's create a few Posts in our database:
            for ($i = 0; $i < 50; $i++) {
                Posts::create([
                    'title' => $faker->sentence,
                    'body' => $faker->paragraph,
                    'likes' => 0,
                    'user_id' => $faker->randomDigitNotNull(),

                ]);
            }
        }
    }
}
