<?php

namespace App\Http\Repositories;

use App\Http\Services\PaginationService;
use App\Http\Services\ProductService;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductRepository
{
    public function __construct(private $productService = new ProductService(), private $paginationService = new PaginationService())
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function indexPromoted()
    {
        $promotedProducts = Cache::get('promotedProducts');
        if ($promotedProducts) {
            return $promotedProducts;
        }
        $promotedProducts = Promotion::valid()->whereHas('product')->with('product.images')->get()->unique('product_id');

        $cacheTimeInSeconds = $promotedProducts->max('due_date')->diffInSeconds(Carbon::now());

        return Cache::remember(
            'promotedProducts',
            $cacheTimeInSeconds,
            fn () => $promotedProducts
        );
    }

    public function index($type = null, $searchKey = null, $filters = null)
    {
        switch ($type) {
            case 'promoted':
                return $this->indexPromoted();
            case 'best-selling':
                return $this->indexBestSelling();
            case 'most-viewed':
                return $this->indexMostViewed();
            case 'latest':
                return $this->indexLatest();
            default:
                return $this->indexFiltered($filters, $searchKey);
        }
    }

    public function indexFiltered($filters = null, $searchKey = null)
    {
        return Product::filter($filters)->search($searchKey)
            ->withCount('views')
            ->with(['wishlistItems.wishList.user', 'images', 'category', 'brand.image'])
            ->paginate(25);
    }

    public function indexBestSelling()
    {
        return $this->paginationService->paginate(
            Product::whereHas('orderItems', function ($query) {
                $query->whereHas('order', function ($orderQuery) {
                    return $orderQuery->where('status', '!=', 4);
                });
            })->withSum('orderItems', 'quantity')->with('images')
                ->orderBy('order_items_sum_quantity', 'DESC'),
            'bestSellingPage',
            5,
            9
        );
    }

    public function indexMostViewed()
    {
        return $this->paginationService->paginate(
            Product::whereHas('views')
                ->with('images')
                ->withCount('views')
                ->orderBy('views_count', 'DESC'),
            'mostViewedPage',
            6,
            15
        );
    }

    public function indexLatest()
    {
        return $this->paginationService->paginate(Product::latest()->with('images'), 'latestProductPage', 6, 15);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::create([
            'title' => $request['title'],
            'category_id' => Category::factory()->create()->id,
            'brand_id' => Brand::factory()->create()->id,
            'price' => random_int(1, 1000),
        ]);

        $product->tag = $this->productService->setTag($product, $this->indexBestSelling(), $this->indexMostViewed());

        return $product;
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product
            ->loadCount('views')
            ->load(['wishlistItems.wishList.user', 'images', 'category', 'brand.image']);

        $product->tag = $this->productService->setTag($product, $this->indexBestSelling(), $this->indexMostViewed());

        // To be fetched from Token or what ever auth system we have
        $product->increaseView(User::inRandomOrder()->first() ?? User::factory()->create());

        return $product;
    }
}
