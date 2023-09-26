<?php

namespace App\Http\Controllers;

use App\Http\Repositories\BrandRepository;
use App\Http\Repositories\CategoryRepository;
use App\Http\Repositories\ProductRepository;

class DashboardController extends Controller
{
    public function __construct(private CategoryRepository $categoryRepository, private BrandRepository $brandRepository, private ProductRepository $productRepository)
    {

    }

    public function index()
    {
        return view('dashboard', [
            'categories' => $this->categoryRepository->index(),
            'promotedProducts' => $this->productRepository->index('promoted'),
            'bestSellingProducts' => $this->productRepository->index('best-selling'),
            'brands' => $this->brandRepository->index(),
            'mostViewedProducts' => $this->productRepository->index('most-viewed'),
            'latestProducts' => $this->productRepository->index('latest'),
        ]);
    }
}
