<?php

namespace App\Http\Resources;

use App\Models\Stage;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
        return [
            'id' => $this->id,
            'title' => $this->title,
            'stage_id' => $this->stage_id ? [
                'id' => Stage::find($this->stage_id)->id,
                'name' => Stage::find($this->stage_id)->name,
            ] : null,
            'created_at' => $this->created_at,
            'chapters' => ChapterResource::collection($this->chapters),
        ];
    }
}
