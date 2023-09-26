<?php

namespace App\Http\Repositories;

use App\Http\Services\PaginationService;
use App\Models\Brand;

class BrandRepository
{
    public function __construct(private $paginationService = new PaginationService())
    {
    }

    public function index()
    {
        return $this->paginationService->paginate(
            Brand::with('image'),
            'brandPage',
            8,
            15
        );
    }
}
