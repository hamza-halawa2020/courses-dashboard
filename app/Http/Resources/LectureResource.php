<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LectureResource extends JsonResource
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
            'price' => $this->price,
            'video_url' => $this->video_url,
            'note_book_url' => $this->note_book_url,
            'des' => $this->des,
            'start' => $this->start,
            'end' => $this->end,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}
