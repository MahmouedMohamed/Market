<?php

namespace App\Models;

class WishListItem extends BaseModel
{
    public $table = 'wish_lists_items';

    public $primaryKey = null;

    public function wishList()
    {
        return $this->belongsTo(WishList::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
