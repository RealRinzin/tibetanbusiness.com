<?php

namespace App\Http\Resources\Restaurant;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RestaurantBasicInfoResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'user_id' => $this->user_id,
            'rate' => $this->rate,
            'banner' => $this->banner,
            'address' => $this->address,
            'location' => $this->location,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'mobile_no' => $this->mobile_no,
            'email' => $this->email,
            'opening_hour' => $this->opening_hour,
            'closing_hour' => $this->closing_hour,
            'instagram' => $this->instagram,
            'facebook' => $this->facebook,
            'website' => $this->website,
            'status' => $this->status,
            // counting the review stars
            'rating' => $this->restaurant_comments->count() > 0 ?round($this->restaurant_comments->sum('rate') / $this->restaurant_comments->count(),1):null,
            // 'posts' => RestaurantMenuPhotoResource::collection($this->whenLoaded('restaurant_menu_photos')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
