<?php

namespace App\Http\Resources\Sale;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SaleBasicInfoResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
