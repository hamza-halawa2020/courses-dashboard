<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserCanAccessResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        $response = [
            'id' => $this->id,
            'created_at' => $this->created_at,
        ];
        if ($this->lecture !== null) {
            $response['lecture'] = new LectureResource($this->lecture);
        }
        if ($this->chapter !== null) {
            $response['chapter'] = new ChapterResource($this->chapter);
        }

        return $response;

    }
}
