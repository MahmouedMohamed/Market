<?php

namespace App\Models;

class WishList extends BaseModel
{
    public $table = 'wish_lists';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(WishListItem::class);
    }
}
