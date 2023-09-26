<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\WishList;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class WishListItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $wishList = WishList::inRandomOrder()->first();
        $product = Product::inRandomOrder()->first();

        return [
            'wish_list_id' => $wishList,
            'product_id' => $product,
        ];
    }
}
