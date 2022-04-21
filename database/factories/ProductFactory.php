<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence();
        return [
            "title" => $title,
            "slug" => Str::slug($title),
            "description" => $this->faker->paragraph,
            "price" => $this->faker->numberBetween($min = 100, $max = 999),
            "inStock" => $this->faker->numberBetween($min = 1, $max = 150),
            "image" => $this->faker->image('public/storage/images',640,480, null, false),
            "category_id" => $this->faker->numberBetween($min = 1, $max = 10),
        ];
    }
}
