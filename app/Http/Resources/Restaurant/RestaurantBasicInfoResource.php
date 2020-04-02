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
            'email' => $this->email,
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
