<?php

namespace App\Http\Resources;

use App\Models\UserCanAccess;
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
        $hasAccess = $user && $this->allLecturesAccessibleByUser($user->id);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'created_at' => $this->created_at,
            'price' => $this->price,
            'lectures' => LectureResource::collection($this->lectures),
            'isPurchased' => $hasAccess ? 'true' : 'false',
        ];
    }

    private function allLecturesAccessibleByUser($userId)
    {
        $lectureIds = $this->lectures->pluck('id')->toArray();

        $accessibleCount = UserCanAccess::where('user_id', $userId)
            ->whereIn('lecture_id', $lectureIds)
            ->count();

        return $accessibleCount === count($lectureIds);
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
