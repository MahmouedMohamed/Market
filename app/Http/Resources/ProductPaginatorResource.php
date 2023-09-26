<?php

namespace App\Http\Resources;

use App\Http\Repositories\ProductRepository;
use App\Http\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductPaginatorResource extends JsonResource
{
    private $bestSellingProducts;

    private $mostViewedProducts;

    public function __construct(private $data, private $productService = new ProductService(), private ProductRepository $productRepository = new ProductRepository())
    {
        $this->bestSellingProducts = $productRepository->indexBestSelling();
        $this->mostViewedProducts = $productRepository->indexMostViewed();
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = collect($this->data->items())->map(function ($item) {
            $item->tag = $this->productService->setTag($item, $this->bestSellingProducts, $this->mostViewedProducts);

            return ProductResource::make($item);
        });

        return [
            'results' => $data,
            'total' => $this->data->total(),
            'path' => $this->data->path(),
            'per_page' => $this->data->perPage(),
            'next_page_url' => $this->data->nextPageUrl(),
            'prev_page_url' => $this->data->previousPageUrl(),
        ];
    }
}
