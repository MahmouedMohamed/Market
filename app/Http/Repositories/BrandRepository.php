<?php

namespace App\Http\Repositories;

use App\Models\Brand;
use Illuminate\Support\Facades\Cache;

class BrandRepository
{
    public function index()
    {
        return Cache::remember('brands', config('app.DEFAULT_CACHE_TIME'), fn () => Brand::with('image')->take(15)->get());
    }
}
