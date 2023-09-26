<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphOne;

class Brand extends BaseModel
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
