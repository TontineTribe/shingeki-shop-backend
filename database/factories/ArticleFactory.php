<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "image_article" => fake()->randomElement(['/images/faker/1.jpg','/images/faker/2.jpg','/images/faker/3.jpg','/images/faker/4.jpg','/images/faker/5.jpg','/images/faker/6.jpg','/images/faker/7.jpg','/images/faker/8.jpg','/images/faker/9.jpg','/images/faker/10.jpg','/images/faker/11.jpg','/images/faker/12.jpg','/images/faker/13.jpg','/images/faker/14.jpg','/images/faker/15.jpg','/images/faker/16.jpg']),
            "name_article" => fake()->sentence,
            "description_article" => fake()->sentences(5,true)

        ];
    }
}
