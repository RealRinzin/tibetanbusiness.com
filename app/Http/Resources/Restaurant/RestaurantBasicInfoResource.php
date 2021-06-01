<?php

namespace App\Http\Resources\Restaurant;

use App\Restaurant\RestaurantComment;
use App\Restaurant\RestaurantOperationDay;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantBasicInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
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
            'card' => $this->card,
            'thumb' => $this->thumb,
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
            'description' => $this->description,
            // counting the review stars
            'rating' => $this->restaurant_comments->count() > 0 ?round($this->restaurant_comments->sum('rate') / $this->restaurant_comments->count(),1):0,
            'facility' => RestaurantFacilityResource::collection($this->restaurant_facilities),
            'comments' => RestaurantCommentResource::collection($this->restaurant_comments),
            'operation' => RestaurantOperationDayResource::collection($this->restaurant_operation_days),
            'food_photos' => RestaurantFoodPhotoResource::collection($this->restaurant_food_photos),
            'menu_photos' => RestaurantMenuPhotoResource::collection($this->restaurant_menu_photos),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
