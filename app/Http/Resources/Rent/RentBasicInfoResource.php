<?php

namespace App\Http\Resources\Rent;

use App\Rent\RentComment;
use App\Rent\RentFacility;
use App\Rent\RentViewPhoto;
use Illuminate\Http\Resources\Json\JsonResource;

class RentBasicInfoResource extends JsonResource
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
            'fare' => $this->fare,
            'rate' => $this->rate,
            'rate_color' => $this->rate_color,
            'banner' => $this->banner,
            'address' => $this->address,
            'location' => $this->location,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'mobile_no' => $this->mobile_no,
            'email' => $this->email,
            'instagram' => $this->instagram,
            'facebook' => $this->facebook,
            'status' => $this->status,
            'accomodation_size' => $this->accomodation_size,
            'description' => $this->description,
            // counting the review stars
            'rating' => $this->rent_comments->count() > 0 ? round($this->rent_comments->sum('rate') / $this->rent_comments->count(), 1) : null,
            'facility' => RentFacilityResource::collection($this->rent_facilities),
            'comments' => RentCommentResource::collection($this->rent_comments),
            'room_photos' => RentRoomPhotoResource::collection($this->rent_room_photos),
            'view_photos' => RentViewPhotoResource::collection($this->rent_view_photos),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
