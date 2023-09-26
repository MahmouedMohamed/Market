<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(100)->create()->each(function ($item) {
            $item->images()->save(Image::factory()->make([
                'path' => Storage::url('products/'.random_int(1, 6).'.png'),
            ]));
        });
    }
}
