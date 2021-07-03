<?php

namespace Database\Factories;

use App\Models\Blogs;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blogs::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [];
    }
}
