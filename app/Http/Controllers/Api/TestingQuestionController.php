<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestingQuestionResource;
use App\Models\AddPointFromQuestion;
use App\Models\Answer;
use App\Models\Point;
use App\Models\PointDetail;
use App\Models\TestingQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TestingQuestionController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $testings = TestingQuestion::where('user_id', $user->id)->with('answer')->get();
        // return response()->json($testings);
        return response()->api(TestingQuestionResource::collection($testings));

    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'answer_id' => 'required',
            'is_right' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $existingAnswer = TestingQuestion::where('user_id', $user->id)
            ->where('answer_id', $request->answer_id)
            ->first();

        if ($existingAnswer) {
            return response()->json([
                'data' => $existingAnswer,
                'error' => 0,
                'message' => '',
            ]);
        }



        $correctAnswer = Answer::where('id', $request->answer_id)->value('is_right');
        if ($request->is_right != $correctAnswer) {
            return response()->json(['message' => 'Wrong answer, best of luck next time', 'error' => 1]);
        } else {

            $testing = TestingQuestion::create([
                'user_id' => $user->id,
                'answer_id' => $request->answer_id,
                'is_right' => $request->is_right,
            ]);

            $point = $this->getOrCreateUserPoint($user);

            $pointDetail = new PointDetail();
            $pointDetail->amount = 10;
            $pointDetail->point_id = $point->id;
            $pointDetail->save();

            $point->total += $pointDetail->amount;
            $point->save();

            $addPointFromQuestion = new AddPointFromQuestion();
            $addPointFromQuestion->point_detail_id = $pointDetail->id;
            $addPointFromQuestion->testing_question_id = $testing->id;
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
        $testingQuestion = TestingQuestion::where('user_id', $user->id)->with('answer')->findOrFail($id);
        return new TestingQuestionResource($testingQuestion);
    }

}
