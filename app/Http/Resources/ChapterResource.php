<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChapterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = $request->user();
        $hasAccess = $user && $this->userCanAccess && $this->userCanAccess->contains('user_id', $user->id);

        return $hasAccess ? $this->fullDetails() : $this->limitedDetails();
    }




    private function fullDetails()
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'created_at' => $this->created_at,
            'price' => $this->price,
            'lectures' => LectureResource::collection($this->lectures),
            'isPururchased' => 'true',

        ];
    }

    private function limitedDetails()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'created_at' => $this->created_at,
            'price' => $this->price,
            'lectures' => LectureResource::collection($this->lectures),
            'isPururchased' => 'false',
        ];
    }
}
