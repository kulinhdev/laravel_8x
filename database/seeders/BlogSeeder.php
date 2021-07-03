<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Blogs;


// Fake Data
use Faker\Factory as Faker;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define FakeData with Faker
        $faker = Faker::create('vn_VN');
        $limit = 10;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('blogs')->insert([
                'title' => $faker->name,
                'image' => $faker->imageUrl,
                'body' => $faker->text,
            ]);
        }

        // Call Factory

    }
}
