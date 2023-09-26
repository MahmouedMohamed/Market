<?php

namespace App\Http\Services;

use App\Models\Product;

class ProductService
{
    public function setTag(Product &$product, $bestSellingProducts, $mostViewedProducts): ?string
    {
        if (in_array($product->id, $bestSellingProducts->pluck('id')->toArray())) {
            return 'Best Selling';
        } elseif (in_array($product->id, $mostViewedProducts->pluck('id')->toArray())) {
            return 'Most Viewed';
        }

        return 'Normal';

    }
}
