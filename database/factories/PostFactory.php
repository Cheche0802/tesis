<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Category;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

            'title' => $this->faker->sentence(),
            'excerpt' => $this->faker->paragraph(),
            'body' => $this->faker->paragraph(),
            'published_at' => $this->faker->dateTime(),
            'category_id' => $this->faker->unsignedInteger()
        ];
    }
}
