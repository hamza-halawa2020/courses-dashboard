<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'parent_phone' => $this->parent_phone,
            'parent_name' => $this->parent_name,
            'image' => $this->image_path,
            'type' => $this->type,
        ];

    }//end of to array

}//end of resource
