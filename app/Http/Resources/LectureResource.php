<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class LectureResource extends JsonResource
{
    public function toArray($request)
    {
        // Get the authenticated user
        $user = $request->user();

        // Check if the user has access to the lecture
        $hasLectureAccess = $user && $this->userCanAccess && $this->userCanAccess->contains('user_id', $user->id);

        // Check if the user has access to the chapter that contains the lecture
        $hasChapterAccess = $user && $this->chapter && $this->chapter->userCanAccess && $this->chapter->userCanAccess->contains('user_id', $user->id);

        // Check if the lecture has already been watched by the user
        $watched = $this->userCanAccess
            ? $this->userCanAccess->where('user_id', $user->id)->where('lecture_id', $this->id)->first()
            : null;

        // Check if the current time is within the allowed time range
        $isWithinTime = $this->isWithinTimeRange();

        // Case 1: User does not have access to the lecture or chapter
        if (!$hasLectureAccess && !$hasChapterAccess) {
            return $this->limitedDetails();
        }

        // Case 2: User has already watched the lecture
        if ($watched && $watched->watched == 1) {
            return $this->alreadyWatchedDetails();
        }

        // Case 3: User has access but the time is outside the allowed range
        if (!$isWithinTime) {
            return $this->outsideTime();
        }

        // Case 4: User has access and the time is within the allowed range
        if ($hasChapterAccess) {
            // User has chapter-level access
            return $this->fullDetails();
        } elseif ($hasLectureAccess) {
            // User has lecture-level access
            return $this->lectureDetails();
        } else {
            // Fallback case, unlikely to occur
            return $this->limitedDetails();
        }
    }

    // Check if the current time is within the allowed time range
    private function isWithinTimeRange()
    {
        $current = Carbon::now(); // Get the current time
        $start = Carbon::parse($this->start); // Parse the start time
        $end = Carbon::parse($this->end); // Parse the end time
        return $current->between($start, $end); // Check if current time is between start and end
    }

    // Response for users outside the allowed time range
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
            'isPururchased' => 'false',
        ];
    }

    // Response for users with full access to the lecture and chapter
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

    // Response for users with lecture-level access
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

    // Response for users who have already watched the lecture
    private function alreadyWatchedDetails()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'message' => "You've already watched this video, You can't watch it again.",
            'watched' => true,
        ];
    }

    // Response for users with limited access
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
