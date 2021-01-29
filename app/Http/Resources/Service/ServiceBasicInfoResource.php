<?php

namespace App\Http\Resources\Service;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceBasicInfoResource extends JsonResource
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
        return[
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'type' => $this->type,
            'rate' => $this->rate,
            'rate_color' => $this->rate_color,
            'banner' => $this->banner,
            'address' => $this->address,
            'location' => $this->location,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'email' => $this->email,
            'mobile_no' => $this->mobile_no,
            'opening_hour'=> $this->opening_hour,
            'closing_hour' => $this->closing_hour,
            'instagram' => $this->instagram,
            'facebook' => $this->facebook,
            'website' => $this->website,
            'status' => $this->status,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'rating' => $this->service_reviews->count() > 0 ? round($this->service_reviews->sum('rate') / $this->service_reviews->count(), 1) : null,

        ];
    }
}
