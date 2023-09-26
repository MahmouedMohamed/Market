<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

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
    public function definition(): array
    {
        $category = Category::inRandomOrder()->first();
        $brand = Brand::inRandomOrder()->first();

        return [
            'id' => Uuid::uuid1()->toString(),
            'title' => $this->faker->name(),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomNumber(),
            'category_id' => $category,
            'brand_id' => $brand,
        ];
    }
}
