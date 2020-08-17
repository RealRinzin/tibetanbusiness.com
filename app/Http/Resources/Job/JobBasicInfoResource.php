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
            'title' => $this->title,
            'organization' => $this->organization,
            'profession' => $this->profession,
            'experience' => $this->experience,
            'nature' => $this->nature,
            'address' => $this->address,
            'salary' => $this->salary,
            'location' => $this->location,
            'mobile_no' => $this->mobile_no,
            'email' => $this->email,
            'instagram' => $this->instagram,
            'facebook' => $this->facebook,
            'status' => $this->status,
            'deadline' => $this->deadline,
            'description' => $this->description,
            // counting the review stars
            // 'questions' => JobQuestionResource::collection($this->job_questions),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
