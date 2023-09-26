<?php

namespace App\Models;

class Category extends BaseModel
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
