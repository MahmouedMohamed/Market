<?php

namespace App\Http\Resources;

class SellerResource extends BaseUserResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->baseData() + [
            'shop_name' => $this->sellerCustomFields->shop_name,
            'shop_address' => $this->sellerCustomFields->shop_address,
            'shop_latitude' => $this->sellerCustomFields->shop_latitude,
            'shop_longitude' => $this->sellerCustomFields->shop_longitude,
        ];
    }
}
