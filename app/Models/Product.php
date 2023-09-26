<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends BaseModel
{
    protected $fillable = [
        'title',
        'category_id',
        'brand_id',
        'price',
    ];

    protected $availableFilters = [
        [
            'accessor' => 'category_id',
            'column' => 'id',
            'relation' => 'category',
        ],
    ];

    protected $availableSearch = [
        [
            'column' => 'title',
        ],
        [
            'column' => 'title',
            'relation' => 'category',
        ],
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function wishlistItems()
    {
        return $this->hasMany(WishListItem::class);
    }

    public function views()
    {
        return $this->hasMany(ProductView::class);
    }

    public function scopeFilter($query, $filters)
    {
        $availableFilters = collect($this->availableFilters)->keyBy('accessor');
        foreach ($filters ?? [] as $key => $value) {
            if (in_array($key, $availableFilters->keys()->toArray())) {
                $filter = $availableFilters[$key];
                if (isset($filter['relation'])) {
                    $query->orwhereHas($filter['relation'], function ($query) use ($filter, $value) {
                        $query->Where($filter['column'], '=', $value);
                    });
                } else {
                    $query->Where($filter['column'], '=', $value);
                }
            }
        }

        return $query;
    }

    public function scopeSearch($query, $searchKey)
    {
        if ($searchKey) {
            foreach ($this->availableSearch as $key) {
                if (isset($key['relation'])) {
                    $query->orwhereHas($key['relation'], function ($query) use ($key, $searchKey) {
                        $query->Where($key['column'], 'like', '%'.$searchKey.'%');
                    });
                }
                //in Same Entity
                else {
                    $query->Where($key['column'], 'like', '%'.$searchKey.'%');
                }
            }
        }

        return $query;
    }

    public function increaseView($user)
    {
        $this->views()->create([
            'user_id' => $user->id,
        ]);
    }
}
