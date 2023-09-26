<?php

namespace App\Models;

class ProductView extends BaseModel
{
    public $table = 'products_views';

    public $primaryKey = null;

    public $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
