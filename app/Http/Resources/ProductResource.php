<?php

namespace App\Http\Resources;

use App\Traits\Formatter;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    use Formatter;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'number_of_views' => $this->views_count ?? 0,
            'images' => ImageResource::collection($this->images),
            'category' => CategoryResource::make($this->category),
            'brand' => BrandResource::make($this->brand),
            'tag' => $this->tag ?? 'Normal',
            'wish_list_customers' => $this->wishlistItems->pluck('wishList.user.name'),
            'price' => $this->formatCurrency($this->price),
            'created_at' => $this->formatDateTime($this->created_at),
        ];
    }
}
