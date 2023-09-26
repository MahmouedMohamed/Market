<?php

namespace App\Http\Controllers;

use App\Http\Repositories\BrandRepository;
use App\Http\Repositories\CategoryRepository;
use App\Http\Repositories\ProductRepository;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;

class DashboardController extends Controller
{
    public function __construct(private CategoryRepository $categoryRepository, private BrandRepository $brandRepository, private ProductRepository $productRepository)
    {

    }

    public function index()
    {
        return view('dashboard', [
            'categories' => CategoryResource::collection($this->categoryRepository->index()),
            'promotedProducts' => $this->productRepository->index('promoted'),
            'bestSellingProducts' => ProductResource::collection($this->productRepository->index('best-selling')),
            'brands' => $this->brandRepository->index(),
            'mostViewedProducts' => ProductResource::collection($this->productRepository->index('most-viewed')),
            'latestProducts' => ProductResource::collection($this->productRepository->index('latest')),
        ]);
    }
}
