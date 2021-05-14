<?php

namespace App\Http\Resources\Event;

use App\Event\EventInterest;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class EventInfoBasicResource extends JsonResource
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
            'rate' => $this->rate,
            'rate_color' => $this->rate_color,
            'entry_free' => $this->entry_free,
            'rating' => $this->event_reviews->count() > 0 ? round($this->event_reviews->sum('rate') / $this->event_reviews->count(), 1) : 0,
            'interested' => $this->event_interests->count(),
            'name' => $this->name,
            'banner' => $this->banner,
            'card' => $this->card,
            'thumb' => $this->thumb,
            'email' => $this->email,
            'location' => $this->location,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'category'=>$this->category,
            'address' => $this->address,
            'mobile_no' => $this->mobile_no,
            'entry_fee' => $this->entry_fee,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'description'=>$this->description,
            'start_time' =>$this->start_time,
            'end_time' =>$this->end_time,
            'instagram' => $this->instagram,
            'facebook' => $this->facebook,
            'website' => $this->website,
            'status' => $this->status,
            'featured_ad' => $this->featured_ad,
            'home_ad' => $this->home_ad,
            'sidebar_ad' => $this->sidebar_ad,
            'popup_ad' => $this->popup_ad,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'event_interested' => EventInterestResource::collection($this->event_interests),

        ];
    }
}
