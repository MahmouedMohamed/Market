<?php

namespace Database\Seeders;

use App\Models\WishList;
use App\Models\WishListItem;
use Illuminate\Database\Seeder;

class WishListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WishList::factory(20)->create()->each(function ($item) {
            $item->items()->save(WishListItem::factory()->make());
        });
    }
}
