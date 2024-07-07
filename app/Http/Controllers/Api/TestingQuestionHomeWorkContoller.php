<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestingQuestionHomeWorkResource;
use App\Models\AddPointFromQuestionHomeWork;
use App\Models\AnswerHomeWork;
use App\Models\TestingQuestionHomeWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\PointDetail;
use App\Models\Point;

class TestingQuestionHomeWorkContoller extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $testings = TestingQuestionHomeWork::where('user_id', $user->id)->with('answerHomeWork')->get();
        // return response()->json($testings);
        return response()->api(TestingQuestionHomeWorkResource::collection($testings));

    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'answer_hw_id' => 'required',
            'is_right' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }


        $correctAnswer = AnswerHomeWork::where('id', $request->answer_hw_id)->value('is_right');
        if ($request->is_right != $correctAnswer) {
            return response()->json('wrong answer best of luck next time');

        } else {

            $testing = TestingQuestionHomeWork::create([
                'user_id' => $user->id,
                'answer_hw_id' => $request->answer_hw_id,
                'is_right' => $request->is_right,
            ]);

            $point = $this->getOrCreateUserPoint($user);

            $pointDetail = new PointDetail();
            $pointDetail->amount = 10;
            $pointDetail->point_id = $point->id;
            $pointDetail->save();

            $point->total += $pointDetail->amount;
            $point->save();

            $addPointFromQuestion = new AddPointFromQuestionHomeWork();
            $addPointFromQuestion->point_detail_id = $pointDetail->id;
            $addPointFromQuestion->testing_q_h_w_id = $testing->id;
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
        $testingQuestion = TestingQuestionHomeWork::where('user_id', $user->id)->with('answerHomeWork')->findOrFail($id);
        // return response()->json($testings);
        return new TestingQuestionHomeWorkResource($testingQuestion);
    }

}

