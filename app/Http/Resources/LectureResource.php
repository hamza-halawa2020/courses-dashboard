<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LectureResource extends JsonResource
{
    public function toArray($request)
    {
        $user = $request->user();

        $hasLectureAccess = $user && $this->userCanAccess && $this->userCanAccess->contains('user_id', $user->id);
        $hasChapterAccess = $user && $this->chapter && $this->chapter->userCanAccess && $this->chapter->userCanAccess->contains('user_id', $user->id);

        if ($hasChapterAccess) {
            return $this->fullDetails();
        } elseif ($hasLectureAccess) {
            return $this->lectureDetails();
        } else {
            return $this->limitedDetails();
        }
    }

    private function fullDetails()
    {
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
            'question_home_works' => QuestionHomeWorkResource::collection($this->questionHomeWorks),
            'exam_lectures' => ExamLectureResource::collection($this->examLectures),
        ];
    }

    private function lectureDetails()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'video_url' => $this->video_url,
            'des' => $this->des,
            'start' => $this->start,
            'end' => $this->end,
            'status' => $this->status,
        ];
    }

    private function limitedDetails()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'des' => $this->des,
        ];
    }
}
