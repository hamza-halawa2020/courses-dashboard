<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeacherResource;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{


    public function index()
    {
        $user = Auth::user();
        $stageId = $user->stage_id;
        $teachers = Teacher::whereHas('courses', function ($query) use ($stageId) {
            $query->where('stage_id', $stageId);
        })->with([
                    'courses' => function ($query) use ($stageId) {
                        $query->where('stage_id', $stageId);
                    }
                ])->get();

        return response()->api(TeacherResource::collection($teachers));
    }


    public function show($id)
    {
        $user = Auth::user();
        $stageId = $user->stage_id;
        $teacher = Teacher::whereHas('courses', function ($query) use ($stageId) {
            $query->where('stage_id', $stageId);
        })->with([
                    'courses' => function ($query) use ($stageId) {
                        $query->where('stage_id', $stageId);
                    }
                ])->findOrFail($id);

        return response()->api(new TeacherResource($teacher));

    }


}
