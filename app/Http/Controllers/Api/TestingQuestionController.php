<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestingQuestionResource;
use App\Models\TestingQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TestingQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $testings = TestingQuestion::where('user_id', $user->id)->with('answer')->get();
        // return response()->json($testings);
        return response()->api(TestingQuestionResource::collection($testings));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            // 'user_id' => 'required',
            'answer_id' => 'required',
            'is_right' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $testing = TestingQuestion::create([
            'user_id' => $user,
            'answer_id' => $request->answer_id,
            'is_right' => $request->is_right,
        ]);
        return response()->api($testing);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $testingQuestion = TestingQuestion::where('user_id', $user->id)->with('answer')->findOrFail($id);
        return new TestingQuestionResource($testingQuestion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
