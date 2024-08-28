<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function __construct(private $data, private $type = null, private $isCollection = false) {}
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $resource = null;
        // ToDo: Can be expanded based on sub type also
        switch ($this->type) {
            case 1:
                $resource = AdminResource::class;
                break;
            case 2:
                $resource = CustomerResource::class;
                break;
            default:
                $resource = SellerResource::class;
        }
        // Check if the data is a collection
        if ($this->isCollection) {
            // Return the collection of resources
            return $resource::collection($this->data);
        } else {
            // Return the single resource
            return (new $resource($this->data))->toArray($request);
        }
    }
}
