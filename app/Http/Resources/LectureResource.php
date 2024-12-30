<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
class LectureResource extends JsonResource
{
    public function toArray($request)
    {
        $user = $request->user();

        $hasLectureAccess = $user && $this->userCanAccess && $this->userCanAccess->contains('user_id', $user->id);
        $hasChapterAccess = $user && $this->chapter && $this->chapter->userCanAccess && $this->chapter->userCanAccess->contains('user_id', $user->id);
        $isWithinTime = $this->isWithinTimeRange();

        // Case 1: User does not have access
        if (!$hasLectureAccess && !$hasChapterAccess) {
            return $this->limitedDetails();
        }

        // Case 2: User has access but the time is outside the allowed range
        if (!$isWithinTime) {
            return $this->outsideTime();
        }

        // Case 3: User has access and the time is within the allowed range
        if ($hasChapterAccess) {
            return $this->fullDetails();
        } elseif ($hasLectureAccess) {
            return $this->lectureDetails();
        } else {
            return $this->limitedDetails(); // Fallback, though this case is unlikely to occur
        }
    }

    private function isWithinTimeRange()
    {
        $current = Carbon::now();
        $start = Carbon::parse($this->start);
        $end = Carbon::parse($this->end);
        return $current->between($start, $end);
    }

    private function outsideTime()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'des' => $this->des,
            'start' => $this->start,
            'end' => $this->end,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'isPururchased' => 'true',
        ];
    }

    private function fullDetails()
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
            'created_at' => $this->created_at,
            'question_home_works' => QuestionHomeWorkResource::collection($this->questionHomeWorks),
            'exam_lectures' => ExamLectureResource::collection($this->examLectures),
            'isPururchased' => 'true',
            'note_book_url' => $this->note_book_url,

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
            'created_at' => $this->created_at,
            'question_home_works' => QuestionHomeWorkResource::collection($this->questionHomeWorks),
            'exam_lectures' => ExamLectureResource::collection($this->examLectures),
            'note_book_url' => $this->note_book_url,
            'isPururchased' => 'true',

        ];
    }

    private function limitedDetails()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'des' => $this->des,
            'isPururchased' => 'false',
        ];
    }
}
