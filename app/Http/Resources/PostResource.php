<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'phone'=>$this->phone,
            'user' => new  UserForPostResource($this->user),
        ];
    }
}
