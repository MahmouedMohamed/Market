<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ProductRepository;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    use ApiResponse;

    public function __construct(private ProductRepository $productRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            return $this->sendResponse(
                $this->productRepository->index('index', $request->input('searchKey'), json_decode($request->input('filters'), true)), 'Data Retrieved Successfully');
        } catch (Exception $ex) {
            Log::error($ex);

            return $this->sendError('Something went wrong', [], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            return $this->sendResponse(ProductResource::make($this->productRepository->store($request)), 'Product Created Successfully', 201);
        } catch (Exception $ex) {
            Log::error($ex);

            return $this->sendError('Something went wrong', [], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        try {
            return $this->sendResponse(ProductResource::make($this->productRepository->show($product)), 'Product Retrieved Successfully');
        } catch (Exception $ex) {
            Log::error($ex);

            return $this->sendError('Something went wrong', [], 500);
        }
    }
}
