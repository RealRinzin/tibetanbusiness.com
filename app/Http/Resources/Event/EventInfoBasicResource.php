<?php

namespace App\Http\Resources\Event;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'rating' => $this->event_reviews->count() > 0 ? round($this->event_reviews->sum('rate') / $this->event_reviews->count(), 1) : 0,
            'name' => $this->name,
            'banner' => $this->banner,
            'email' => $this->email,
            'location' => $this->location,
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
