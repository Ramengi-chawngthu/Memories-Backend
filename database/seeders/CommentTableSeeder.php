<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comments;



class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = \Faker\Factory::create();

        for ($i = 1; $i < 10; $i++) {
            Comments::create([
                'comment' => $faker->paragraph,
                'post_id' => $i,
                'comment_user_id' => $i
            ]);
        }
    }
}
