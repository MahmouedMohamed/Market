<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::factory(10)->create()->each(function ($item) {
            $item->image()->save(Image::factory()->make([
                'path' => Storage::url('brands/default.png'),
            ]));
        });
    }
}
