<?php

namespace Database\Seeders;

use App\Models\ProductView;
use Illuminate\Database\Seeder;

class ProductViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductView::factory(100)->create();
    }
}
