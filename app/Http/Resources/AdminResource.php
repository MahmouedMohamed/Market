<?php

namespace App\Http\Resources;

class AdminResource extends BaseUserResource
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
            // 'id' => $this->id,
        ];
    }
}
