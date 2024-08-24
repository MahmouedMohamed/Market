<?php

namespace App\Models;

class SellerCustomFields extends BaseModel
{
    const USE_UUID = false;

    public $incrementing = true;

    protected $fillable = [
        'id',
        'shop_name',
        'shop_address',
        'shop_latitude',
        'shop_longitude',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
