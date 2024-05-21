<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $userStageId = Auth::user()->stage_id;
        $courses = Course::where('stage_id', $userStageId)->get();
        return response()->api(CourseResource::collection($courses));
    }




    public function show($id)
    {
        $userStageId = Auth::user()->stage_id;
        $course = Course::where('id', $id)
            ->where('stage_id', $userStageId)
            ->first();
        if (!$course) {
            return response()->api([], 1, 'Course not found for the user\'s stage.');
        }

        return response()->api(new CourseResource($course));
    }


}
