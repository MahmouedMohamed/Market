<?php

namespace App\Http\Resources;

class CustomerResource extends BaseUserResource
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
            'university' => $this->studentCustomFields->university,
            'student_number' => $this->studentCustomFields->student_number,
        ];
    }
}
