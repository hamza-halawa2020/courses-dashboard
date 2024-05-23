<?php

namespace App\Http\Resources;

use App\Models\AnswerChapter;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamChapterResource extends JsonResource
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
            'question' => $this->question,
            'created_at' => $this->created_at,
            'answerChapter' => AnswerChapterResource::collection($this->answerChapter),
        ];
    }
}
