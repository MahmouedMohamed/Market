<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;

class Promotion extends BaseModel
{
    protected $casts = [
        'due_date' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeValid(Builder $query)
    {
        return $this->where('due_date', '>', Carbon::now());
    }
}
