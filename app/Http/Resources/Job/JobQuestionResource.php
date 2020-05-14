<?php

namespace App\Http\Resources\Job;

use Illuminate\Http\Resources\Json\JsonResource;

class JobQuestionResource extends JsonResource
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
        // return ['data' => $this->collection];
        // return ['data' => $this->collection];
        return [
            'id' => $this->id,
            'user_id' =>  $this->user_id,
            'job_basic_info_id' => $this->job_basic_info_id,
            'name' => $this->name,
            'avatar' => $this->avatar,
            'question' => $this->question,
            'replies' => JobAnswerResource::collection($this->job_answers),
            'created_at' => $this->created_at,
            'updated_at' =>  $this->updated_at,

        ];
    }
}
