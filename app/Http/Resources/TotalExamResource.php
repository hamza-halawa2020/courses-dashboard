<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class TotalExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $currentTime = Carbon::now();

        $startAt = Carbon::parse($this->start_at);
        $endAt = Carbon::parse($this->end_at);

        if ($startAt->greaterThan($endAt)) {
            $startAt = $endAt->copy()->subDay();
        }

        if ($currentTime->between($startAt, $endAt)) {
            return [
                'id' => $this->id,
                'question' => $this->question,
                'created_at' => $this->created_at,
                'start_at' => $startAt,
                'end_at' => $endAt,
                'answerTotalExam' => AnswerTotalExamResource::collection($this->answerTotalExam),
            ];
        } else {
            return [];
        }
    }
}
