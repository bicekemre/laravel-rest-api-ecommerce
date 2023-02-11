<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = fake()->text(30);
        return [
            'name' => $name,
            'category_id' => rand(1 , 100),
            'price' => fake()->randomFloat(45, 0, 65),
            'lead' => fake()->text(),
            'description' => fake()->text(),
            'slug' => Str::slug($name),
            'quantity' => fake()->randomDigitNotZero(),
            'rating' => fake()->randomDigitNotZero(),
            'views' => fake()->randomDigitNotZero(),
            'is_active' => fake()->boolean(),
            'is_recommended' => fake()->boolean()
        ];
    }
}
