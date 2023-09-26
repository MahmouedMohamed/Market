<?php

namespace App\Http\Resources;

use App\Traits\Formatter;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PromotionResource extends JsonResource
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
            'product' => ProductResource::make($this->product),
            'price' => $this->formatCurrency($this->calculatePrice($this->type, $this->discount, $this->product->price)),
            'due_date' => $this->due_date,
        ];
    }
}
