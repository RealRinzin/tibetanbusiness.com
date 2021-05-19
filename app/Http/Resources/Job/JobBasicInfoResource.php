<?php

namespace App\Http\Resources\Job;

use Illuminate\Http\Resources\Json\JsonResource;

class JobBasicInfoResource extends JsonResource
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
            'banner' => $this->banner,
            'card' => $this->card,
            'thumb' => $this->thumb,
            'title' => $this->title,
            'organization' => $this->organization,
            'profession' => $this->profession,
            'experience' => $this->experience,
            'nature' => $this->nature,
            'address' => $this->address,
            'types' => $this->types,
            'salary' => $this->salary,
            'location' => $this->location,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            // Scholarship
            'course_name' => $this->course_name,
            'graduation' => $this->graduation,
            'country' => $this->country,
            'duration' => $this->duration,
            'mobile_no' => $this->mobile_no,
            'email' => $this->email,
            'instagram' => $this->instagram,
            'facebook' => $this->facebook,
            'website' => $this->website,
            'status' => $this->status,
            'featured_ad' => $this->featured_ad,
            'home_ad' => $this->home_ad,
            'sidebar_ad' => $this->sidebar_ad,
            'popup_ad' => $this->popup_ad,
            'deadline' => $this->deadline,
            'description' => $this->description,
            'applied' => $this->job_applies->count(),
            'interested' => $this->job_interests->count(),
            // counting the review stars
            'job_interested' => JobInterestResource::collection($this->job_interests),
            'job_applied' => JobApplyResource::collection($this->job_applies),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
