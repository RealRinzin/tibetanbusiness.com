<?php

namespace App\Http\Resources\Rent;

use Illuminate\Http\Resources\Json\JsonResource;

class RentRoomPhotoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
