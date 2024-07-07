<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TestingExamLectureResource extends JsonResource
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
        $answer = $this->whenLoaded('answerLecture');
        return [
            'id' => $this->id,
            'is_right' => $this->is_right,
            'created_at' => $this->created_at,
            'answer' => $answer ? [
                'id' => $answer->id,
                'created_at' => $answer->created_at,
                'is_right' => $answer->is_right,
                'answer' => $answer->answer,
                // 'question' => $answer->question,
                'examLecture' => new ExamLectureResource($answer->examLecture),
            ] : null,

        ];
    }
}
