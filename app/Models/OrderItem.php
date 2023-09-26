<?php

namespace App\Models;

class OrderItem extends BaseModel
{
    public $table = 'orders_items';

    public $timestamps = false;

    public $primaryKey = null;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
