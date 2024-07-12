<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestingExamLectureResource;
use App\Models\AddPointFromExamLecture;
use App\Models\AnswerLecture;
use App\Models\TestingExamLecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\PointDetail;
use App\Models\Point;

class TestingExamLectureContoller extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $testings = TestingExamLecture::where('user_id', $user->id)->with('answerLecture')->get();
        // return response()->json($testings);
        return response()->api(TestingExamLectureResource::collection($testings));

    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'answer_lecture_id' => 'required',
            'is_right' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $existingAnswer = TestingExamLecture::where('user_id', $user->id)
            ->where('answer_lecture_id', $request->answer_lecture_id)
            ->first();

        if ($existingAnswer) {
            return response()->json([
                'message' => 'You have already answered this question.',
                'answer' => $existingAnswer,
                'error' => '1'
            ]);
        }


        $correctAnswer = AnswerLecture::where('id', $request->answer_lecture_id)->value('is_right');
        if ($request->is_right != $correctAnswer) {
            return response()->json(['message' => 'Wrong answer, best of luck next time', 'error' => '1']);

        } else {

            $testing = TestingExamLecture::create([
                'user_id' => $user->id,
                'answer_lecture_id' => $request->answer_lecture_id,
                'is_right' => $request->is_right,
            ]);

            $point = $this->getOrCreateUserPoint($user);

            $pointDetail = new PointDetail();
            $pointDetail->amount = 10;
            $pointDetail->point_id = $point->id;
            $pointDetail->save();

            $point->total += $pointDetail->amount;
            $point->save();

            $addPointFromQuestion = new AddPointFromExamLecture();
            $addPointFromQuestion->point_detail_id = $pointDetail->id;
            $addPointFromQuestion->testing_exam_lecture_id = $testing->id;
            $addPointFromQuestion->save();
        }
        return response()->api($testing);
    }

    protected function getOrCreateUserPoint($user)
    {
        if ($user->points->isEmpty()) {
            $point = new Point();
            $point->total = 0;
            $point->user_id = $user->id;
            $point->save();
        } else {
            $point = $user->points->first();
        }
        return $point;
    }


    public function show($id)
    {
        $user = Auth::user();
        $testingQuestion = TestingExamLecture::where('user_id', $user->id)->with('answerLecture')->findOrFail($id);
        return new TestingExamLectureResource($testingQuestion);
    }


}


